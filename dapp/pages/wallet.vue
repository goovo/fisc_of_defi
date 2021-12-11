<template>
	<view>

	</view>
</template>
<script setup>
	import Web3 from "web3";
	import {
		convertUtf8ToHex
	} from "@walletconnect/utils";
	import Web3Modal from "web3modal";
	import WalletConnectProvider from "@walletconnect/web3-provider";
	import contractErc20 from "@/dapp/contracts/ERC20.json";
	import contractGinPledge from "@/dapp/contracts/GinPledge.json";

	export default {
		data() {
			return {
				network: "mainnet",
				rpc: "https://data-seed-prebsc-1-s1.binance.org:8545/",
				chainId: 97,
				infuraId: "3f69bb480fc140c1b51bd7e842fa1a7f",
				web3: null,
				provider: null,
				contractAddress: "0x4d08f25f54b15a1fcb3e7fa6db417bd20352b22f",
				currentAccount: "",
				contracts: {},
			}
		},
		mounted() {
			this.init();
		},
		onShow() {

		},
		onHide() {},
		methods: {
			init: async function() {
				this.initWeb3Modal();
			},
			initWeb3Modal: async function() {
				try {
					const chainId = this.chainId;
					const providerOptions = {
						walletconnect: {
							package: WalletConnectProvider,
							options: {
								rpc: {
									chainId: this.rpc,
								},
							},
						}
					};

					const web3Modal = new Web3Modal({
						//network: this.network, // optional
						cacheProvider: false, // optional
						providerOptions, // required
						theme: {
							background: "rgb(255, 255, 255)",
							main: "rgb(30, 30, 30)",
							secondary: "rgb(136, 136, 136)",
							border: "rgba(195, 195, 195, 0.14)",
							hover: "rgb(230, 230, 230)"
						}
					});
					web3Modal.clearCachedProvider();
					// if (web3Modal.cachedProvider) {
					// 	await web3Modal.connect();
					// }
					const provider = await web3Modal.connect();

					if (!provider.on) {
						console.info("连接失败");
						return false;
					}
					provider.on("connect", async (info) => {
						let chainId = parseInt(info.chainId)
						//commit('setChainId', chainId)
						console.info("connect2222", info)
					});

					provider.on("accountsChanged", async (accounts) => {
						// if (accounts.length > 0) {
						// 	commit('setAccount', accounts[0])
						// } else {
						// 	await dispatch('resetApp')
						// }
						console.info("accountsChanged")
					});
					provider.on("chainChanged", async (chainId) => {
						chainId = parseInt(chainId)
						//commit('setChainId', chainId)
						console.info("chainChanged", chainId)
					});
					provider.on("networkChanged", async (networkId) => {
						console.info("networkChanged", chainId)
						// const {
						// 	web3
						// } = this.state;
						// const chainId = await web3.eth.chainId();
						// await this.setState({
						// 	chainId,
						// 	networkId
						// });
						// await this.getAccountAssets();
					});

					this.provider = provider;
					this.web3 = new Web3(provider);
					this.initContracts();
				} catch (e) {
					console.info(e);
					return false;
				}
			},
			initContracts() {
				const provider = this.provider;
				const web3 = this.web3;
				const contractAddress = this.contractAddress
				web3.eth.getAccounts(function(error, accounts) {
					this.currentAccount = accounts[0];
					var account = accounts[0];
					if (!error)
						console.info(accounts)

					web3.eth.defaultAccount = account;

					//erc20合约对象
					var contract_erc20 = new web3.eth.Contract(contractErc20.abi);
					contract_erc20.setProvider(provider);
					contract_erc20.options.address = "0x4d08f25f54b15a1fcb3e7fa6db417bd20352b22f";
					contract_erc20.options.from = account;
					console.info(contract_erc20);

					//授权
					// contract_erc20.methods.approve("0xfab33bb5546a5780115a971db3dc0edcd043ba7b", 5000000000000)
					// 	.send({
					// 		from: account
					// 	});

					// 代币余额
					contract_erc20.methods.balanceOf(account).call({}, function(error, result) {
						if (!error) {
							console.log(result);
						} else {
							console.log(error);
						}
					});

					//---------------------------------------------------//
					//质押合约对象
					var contract_ginPledge = new web3.eth.Contract(contractGinPledge.abi);
					contract_ginPledge.setProvider(provider);
					contract_ginPledge.options.address = "0xfab33bb5546a5780115a971db3dc0edcd043ba7b";
					contract_ginPledge.options.from = account;

					// gas费用
					// contract_ginPledge.methods.pledgeToken(11111000000).estimateGas({
					// 	from: account,
					// }).then(function(gasAmount) {
					// 	console.info(gasAmount);
					// }).catch(function(error) {
					// 	console.info(error);
					// });

					//质押
					// contract_ginPledge.methods.pledgeToken(11111000000).send({}, function(error, result) {
					// 	if (error) {
					// 		console.info(error);
					// 	} else {
					// 		console.log('result: ' + result);
					// 	}
					// });

					// contract.methods.takeToken(100).call().then(function(result) {
					// 	console.info(result);
					// });
					// contract.methods.takeAllToken().call().then(function(result) {
					// 	console.info(result);
					// });

					//查询FISC的质押数量
					// contract_ginPledge.methods.getPledgeToken(account).call().then(function(result) {
					// 	console.info(result);
					// });

					//查询获得FIL奖励的数额
					// contract_ginPledge.methods.getfilToken(account).call().then(function(result) {
					// 	console.info(result);
					// });

					//查询用户上一次收取FIL奖励的时间戳
					// contract_ginPledge.methods.getTakeProfitTime(account).call().then(function(result) {
					// 	console.info(result);
					// });

				});
			}
		}
	}
</script>
<style>
	.sc-jSFkmK {
		opacity: 1 !important;
		visibility: visible !important;
	}

	.sc-gKAblj {
		opacity: 1 !important;
		visibility: visible !important;
	}

	.sc-fujyUd {
		opacity: 1 !important;
		visibility: visible !important;
	}
</style>
