import Web3 from 'web3';

export default {
	rpc: "http://localhost:8545",
	web3: null,
	web3Provider: null,
	walletConnectProvider: null,
	contracts: {},
	init: async function() {
		console.info("init");
		//return await this.initWeb3();
	},
	initWeb3: async function() {
		if (window.ethereum) {
			this.web3 = new Web3(window.ethereum);
			window.ethereum.enable();
		} else {
			this.web3 = new Web3(new Web3.providers.HttpProvider(this.rpc));
		}
		console.info(2222222);

		this.web3.eth.getAccounts(function(error, result) {
			if (!error)
				console.log(result) //授权成功后result能正常获取到账号了
		});


		//return initContract();
	},
	initContract: function() {
		$.getJSON('Adoption.json', function(data) {
			var AdoptionArtifact = data;

			contracts.Adoption = TruffleContract(AdoptionArtifact);
			contracts.Adoption.setProvider(web3Provider);

			return markAdopted();
		});

		return bindEvents();
	},

	bindEvents: function() {
		$(document).on('click', '.btn-adopt', handleAdopt);
	},

	markAdopted: function() {
		var apotionInstance;
		contracts.Adoption.deployed().then(function(instance) {
			apotionInstance = instance;
			return apotionInstance.getAdopters.call();
		}).then(function(adopters) {

			for (i = 0; i < adopters.length; i++) {
				console.log(adopters[i]);
				if (adopters[i] !== '0x0000000000000000000000000000000000000000') {
					$('.panel-pet').eq(i).find('button').text('Success').attr('disabled', true);
				}
			}
		}).catch(function(err) {
			console.log(err.message);
		})
	},

	handleAdopt: function(event) {
		event.preventDefault();
		var apotionInstance;
		var petId = parseInt($(event.target).data('id'));

		web3.eth.getAccounts(function(error, accounts) {
			var account = accounts[0];

			contracts.Adoption.deployed().then(function(instance) {
				apotionInstance = instance;

				return apotionInstance.adopt(petId, {
					from: account
				});
			}).then(function(result) {
				return markAdopted();
			}).catch(function(err) {
				console.log(err.message);
			});
		});
	}
}
