<?php
namespace app\common\library;

use think\Config;
use think\Log;

/**
 * 交易所網關接口
 * 支持插件化對接不同的交易所（如 bbank）
 * ThinkPHP 5 適配版
 */
abstract class ExchangeGateway
{
    protected $config;

    public function __construct(array $config = [])
    {
        $this->config = $config ?: $this->getDefaultConfig();
    }

    abstract protected function getDefaultConfig();

    abstract public function getBalance(string $currency): array;

    abstract public function placeOrder(string $side, string $currency, float $amount, float $price): array;

    abstract public function getOrderStatus(string $orderId): array;

    abstract public function cancelOrder(string $orderId): bool;

    abstract public function getPrice(string $currency): float;

    abstract protected function sign(array $params): string;

    protected function request(string $method, string $endpoint, array $params = []): array
    {
        $url = rtrim($this->config['base_url'], '/') . '/' . ltrim($endpoint, '/');
        $params['sign'] = $this->sign($params);
        $params['timestamp'] = isset($params['timestamp']) ? $params['timestamp'] : time();

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'X-API-Key: ' . ($this->config['api_key'] ?? ''),
            ],
            CURLOPT_TIMEOUT => $this->config['timeout'] ?? 30,
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error) {
            Log::error('ExchangeGateway request failed: ' . $error . ' url=' . $url);
            throw new \Exception('交易所請求失敗: ' . $error);
        }

        if ($httpCode !== 200) {
            Log::error('ExchangeGateway request failed HTTP ' . $httpCode . ' response=' . $response);
            throw new \Exception('交易所請求失敗: HTTP ' . $httpCode);
        }

        $data = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('交易所響應解析失敗');
        }

        return $data;
    }
}
