
new Vue({


	el: 'body',

	data: {

		linha: {
			success: false,
			loading: false
		},

		grupo: {
			success: false,
			loading: false
		},

		subGrupo: {
			success: false,
			loading: false
		},

		fornecedor: {
			success: false,
			loading: false
		},

		cliente: {
			success: false,
			loading: false
		},

		produto: {
			success: false,
			loading: false
		},

		erro: {
			return: false,
			modulo: ''
		}

	},


	methods: {

		insereLinha()
		{
			this.linha.loading = true;
			this.$http.get('./public/Views/Linha/Linha.php').then((response) => {
				this.linha.loading = false;
				this.linha.success = true;
			}, (response) => {
				console.log('erro ao iniciar chamada');
			});

		},

		insereGrupo()
		{
			this.grupo.loading = true;
			this.$http.get('./public/Views/Grupo/Grupo.php').then((response) => {
				this.grupo.loading = false;
				this.grupo.success = true;
			console.log(response);

			}, (response) => {
				console.log('erro ao iniciar chamada');
			});

		},

		insereSubGrupo()
		{
			this.subGrupo.loading = true;
			this.$http.get('./public/Views/SubGrupo/SubGrupo.php').then((response) => {
				this.subGrupo.loading = false;
				this.subGrupo.success = true;
			}, (response) => {
				console.subGrupo('erro ao iniciar chamada');
			});

		},

		insereFornecedor()
		{
			this.fornecedor.loading = true;
			this.$http.get('./public/Views/Fornecedor/Fornecedor.php').then((response) => {
				this.fornecedor.loading = false;

				if(JSON.parse(response.data) == "OK")
				{
					this.fornecedor.success = true;
				}

				if(JSON.parse(response.data) == null)
				{
					this.erro.return = true;
					this.erro.modulo = 'Fornecedor';
				}

			}, (response) => {
				this.erro = JSON.parse(response.data);
				console.subGrupo(JSON.parse(response.data));
			});

		},

		insereCliente()
		{
			this.cliente.loading = true;
			this.$http.get('./public/Views/Cliente/Cliente.php').then((response) => {
				this.cliente.loading = false;
				this.cliente.success = true;
			}, (response) => {
				console.subGrupo(JSON.parse(response.data));
			});

		},

		insereProduto()
		{
			this.produto.loading = true;
			this.$http.get('./public/Views/Produto/Produto.php').then((response) => {
				this.produto.loading = false;
				this.produto.success = true;
			}, (response) => {
				console.subGrupo('erro ao iniciar chamada');
			});

		}
	}
})