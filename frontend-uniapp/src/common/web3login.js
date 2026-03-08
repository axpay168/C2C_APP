import Web3 from "web3";
export function web3login() {
    return new Promise((resolve, reject) => {
        if (window.ethereum) {
            //签名
            window.ethereum.enable().then((res) => {
                let walletAddress = res[0];
                // console.log(walletAddress)
                let web3 = new Web3(window.web3.currentProvider); // 当前网络节点
                // console.log(web3)
                web3.eth.personal.sign('register', walletAddress, '123456', (err, res) => {
                    // console.log(err,res)
                    if (res) {
                        resolve(res);
                    } else {
                        uni.removeStorage({
                            key: 'token',
                        })
                        uni.removeStorage({
                            key: 'userId',
                        })
                        reject(err)
                    }
                });
            })
        } else {
            alert("Wallet connection failed")
        }
    })
}
