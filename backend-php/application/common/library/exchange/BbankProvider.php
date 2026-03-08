<?php
namespace app\common\library\exchange;

use app\common\library\ExchangeGateway;
use think\Config;
use think\Log;

/**
 * bbank 交易所 Provider - ThinkPHP 5 適配版
 * 對接 bbank API：餘額查詢、下單/撤單、訂單查詢、價格查詢
 * 配置：application/extra/exchange.php 或 fa_config 表
 */
class BbankProvider extends ExchangeGateway
{
    protected $retryTimes = 3;
    protected $retryDelay = 1;

    protected function getDefaultConfig()
    {
        return [
            'base_url' => Config::get('exchange.bbank.base_url') ?: 'https://api.bbank.com',
            'api_key' => Config::get('exchange.bbank.api_key') ?: '',
            'api_secret' => Config::get('exchange.bbank.api_secret') ?: '',
            'timeout' => Config::get('exchange.bbank.timeout') ?: 30,
            'retry_times' => Config::get('exchange.bbank.retry_times') ?: 3,
        ];
    }

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->retryTimes = $this->config['retry_times'] ?? 3;
    }

    public function getBalance(string $currency): array
    {
        $lastException = null;
        for ($i = 0; $i < $this->retryTimes; $i++) {
            try {
                $response = $this->requestWithRetry('POST', '/api/v1/balance', [
                    'currency' => strtoupper($currency),
                ]);
                if (!isset($response['code']) || $response['code'] !== 1) {
                    throw new \Exception($response['msg'] ?? '獲取餘額失敗');
                }
                $data = $response['data'] ?? [];
                return [
                    'available' => floatval($data['available'] ?? $data['available_balance'] ?? 0),
                    'frozen' => floatval($data['frozen'] ?? $data['frozen_balance'] ?? 0),
                ];
            } catch (\Exception $e) {
                $lastException = $e;
                if ($i < $this->retryTimes - 1) sleep($this->retryDelay);
            }
        }
        throw new \Exception('獲取餘額失敗: ' . $lastException->getMessage());
    }

    public function placeOrder(string $side, string $currency, float $amount, float $price): array
    {
        if (!in_array(strtoupper($side), ['BUY', 'SELL'])) {
            throw new \Exception('交易方向必須是 BUY 或 SELL');
        }
        if ($amount <= 0 || $price <= 0) {
            throw new \Exception('數量和價格必須大於0');
        }
        $symbol = str_replace('/', '-', strtoupper($currency));
        $lastException = null;
        for ($i = 0; $i < $this->retryTimes; $i++) {
            try {
                $response = $this->requestWithRetry('POST', '/api/v1/order', [
                    'side' => strtoupper($side),
                    'symbol' => $symbol,
                    'amount' => number_format($amount, 8, '.', ''),
                    'price' => number_format($price, 8, '.', ''),
                ]);
                if (!isset($response['code']) || $response['code'] !== 1) {
                    throw new \Exception($response['msg'] ?? '下單失敗');
                }
                $data = $response['data'] ?? [];
                return [
                    'order_id' => $data['order_id'] ?? $data['orderId'] ?? '',
                    'status' => $data['status'] ?? 'PENDING',
                ];
            } catch (\Exception $e) {
                $lastException = $e;
                if ($i < $this->retryTimes - 1) sleep($this->retryDelay);
            }
        }
        throw new \Exception('下單失敗: ' . $lastException->getMessage());
    }

    public function getOrderStatus(string $orderId): array
    {
        if (empty($orderId)) throw new \Exception('訂單ID不能為空');
        $lastException = null;
        for ($i = 0; $i < $this->retryTimes; $i++) {
            try {
                $response = $this->requestWithRetry('GET', '/api/v1/order/' . urlencode($orderId));
                if (!isset($response['code']) || $response['code'] !== 1) {
                    throw new \Exception($response['msg'] ?? '查詢訂單失敗');
                }
                $data = $response['data'] ?? [];
                return [
                    'status' => $data['status'] ?? 'UNKNOWN',
                    'filled_amount' => floatval($data['filled_amount'] ?? $data['filledAmount'] ?? 0),
                    'total_amount' => floatval($data['total_amount'] ?? $data['totalAmount'] ?? 0),
                    'price' => floatval($data['price'] ?? 0),
                ];
            } catch (\Exception $e) {
                $lastException = $e;
                if ($i < $this->retryTimes - 1) sleep($this->retryDelay);
            }
        }
        throw new \Exception('查詢訂單失敗: ' . $lastException->getMessage());
    }

    public function cancelOrder(string $orderId): bool
    {
        if (empty($orderId)) throw new \Exception('訂單ID不能為空');
        $lastException = null;
        for ($i = 0; $i < $this->retryTimes; $i++) {
            try {
                $response = $this->requestWithRetry('POST', '/api/v1/order/' . urlencode($orderId) . '/cancel');
                if (!isset($response['code']) || $response['code'] !== 1) {
                    throw new \Exception($response['msg'] ?? '取消訂單失敗');
                }
                return true;
            } catch (\Exception $e) {
                $lastException = $e;
                if ($i < $this->retryTimes - 1) sleep($this->retryDelay);
            }
        }
        throw new \Exception('取消訂單失敗: ' . $lastException->getMessage());
    }

    public function getPrice(string $currency): float
    {
        $symbol = str_replace('/', '-', strtoupper($currency));
        $lastException = null;
        for ($i = 0; $i < $this->retryTimes; $i++) {
            try {
                $response = $this->requestWithRetry('GET', '/api/v1/ticker', ['symbol' => $symbol]);
                if (!isset($response['code']) || $response['code'] !== 1) {
                    throw new \Exception($response['msg'] ?? '獲取價格失敗');
                }
                $data = $response['data'] ?? [];
                $price = $data['price'] ?? $data['last_price'] ?? $data['lastPrice'] ?? 0;
                return floatval($price);
            } catch (\Exception $e) {
                $lastException = $e;
                if ($i < $this->retryTimes - 1) sleep($this->retryDelay);
            }
        }
        throw new \Exception('獲取價格失敗: ' . $lastException->getMessage());
    }

    protected function sign(array $params): string
    {
        unset($params['sign']);
        ksort($params);
        $string = '';
        foreach ($params as $key => $value) {
            $string .= $key . '=' . (is_array($value) ? json_encode($value, JSON_UNESCAPED_UNICODE) : $value) . '&';
        }
        $string = rtrim($string, '&') . '&secret=' . ($this->config['api_secret'] ?? '');
        return md5($string);
    }

    protected function requestWithRetry(string $method, string $endpoint, array $params = [])
    {
        if (empty($this->config['api_key']) || empty($this->config['api_secret'])) {
            throw new \Exception('bbank API 配置不完整，請檢查 api_key 和 api_secret');
        }
        $params['api_key'] = $this->config['api_key'];
        $params['timestamp'] = time() * 1000;
        return $this->request($method, $endpoint, $params);
    }
}
