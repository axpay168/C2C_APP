#!/bin/bash
# 釋放 8082 端口後啟動靜態服務
cd "$(dirname "$0")/.."
echo "釋放 8082 端口..."
fuser -k 8082/tcp 2>/dev/null || true
sleep 2
echo "啟動靜態 H5 服務 (http://localhost:8082)..."
exec npx serve static-h5 -l 8082 -n
