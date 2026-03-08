export default {
	common: {
		mixRecharge: ["Veuillez entrer votre adresse e-mail"],
		language: "Langue",
		yhk: "BankCard",
		txfs: "Way",
		common: ["Service client en ligne", "Désactiver la flottabilité", "Confirmer", "Annuler"],
		upload: ["Téléchargement en cours...", "Format incorrect", "Téléchargement réussi", "Échec du téléchargement"],
		vanPull: ["Aucune donnée supplémentaire", "Pas de données"],
		login: {
			text: ["Langue", "BITCOIN", "Se connecter"],
			label: ["Connexion en cours...", "Se connecter maintenant"],
			placeholder: ["Entrez votre adresse e-mail", "Entrez le mot de passe de connexion"],
			default: ["Pas de compte ?", "S'inscrire maintenant", "Mot de passe oublié ?",
				"Oubli du mot de passe de connexion"
			],
			codes: ["Le compte n'existe pas", "Mot de passe incorrect", "Le compte est bloqué", "Échec"]
		},
		register: {
			text: ["BITCOIN", "Envoi du code de vérification...", "Cliquez pour obtenir", "Inscription en cours...",
				"S'inscrire maintenant"
			],
			placeholder: ["Entrez votre adresse e-mail", "Entrez le code de vérification",
				"Entrez le mot de passe de connexion", "Veuillez confirmer votre mot de passe",
				"Entrez le code d'invitation", "Les deux mots de passe ne sont pas identiques",
				"Entrez le code de vérification", "Adresse e-mail invalide"
			],
			label: ["Déjà un compte ? {a} {line}", "Retour à la page de connexion"],
			codes: ["Le compte existe déjà", "Pas de code de vérification", "Code de vérification incorrect",
				"Les deux mots de passe ne correspondent pas", "Le parrain n'existe pas", "Échec"
			]
		},
		resetpwd: ["Mot de passe oublié", "Entrez votre adresse e-mail", "Entrez le code de vérification",
			"Cliquez pour obtenir", "Entrez le mot de passe", "Réinitialiser le mot de passe"
		],
		footer: ["Accueil", "Hall", "Commande", "Moi"],
		home: {
			label: ["Bienvenue"],
			broadcast: "Félicitations à {member} pour être devenu {grade}",
			menu: ["Journal des fonds", "Tutoriel pour débutant", "Inscription par invitation",
				"Contacter le service client"
			],
			noticeTitle: "Dernières annonces",
			msg: "La tâche n'est pas encore disponible",
			video: "Pas de tutoriel vidéo"
		},
		hall: {
			default: ["Salle de trading", "Solde", "Acheter", "Vendre", "Confirmer la vente", "Liste des commandes",
				"Commandes de vente", "Vendre au marchand", "En attente d'une commande", "Acheter",
				"Aller à la vente"
			],
			list: ["Quantité", "Prix unitaire", "Non exécuté", "Vendre USDT", "Entrez la quantité de USDT à vendre",
				"Montant reçu", "Crédit", "Acheter USDT", "Coût total"
			],
			kbip: ["Annuler", "Montant dépassé", "Doit être dans la plage de montants"]
		},
		msglist: ["Liste des messages"],
		sell: {
			placeholder: ["Entrez le prix de vente", "Entrez la quantité de vente"],
			label: ["Solde (USDT)", "Nom", "Compte bancaire", "Prix actuel (USDT)", "Meilleur prix de vente",
				"Prix de vente", "Quantité de vente", "Meilleur prix", "Tout", "Confirmer la vente"
			]
		},
		buy: {
			placeholder: ["Entrez le prix d'achat", "Entrez la quantité d'achat", "Crédit minimum", "Crédit maximum"],
			label: ["Solde (USDT)", "Nom", "Compte bancaire", "Prix actuel (USDT)", "Meilleur prix d'achat",
				"Prix d'achat", "Quantité d'achat", "Meilleur prix", "Tout", "Confirmer l'achat", "Crédit"
			],
		},
		user: {
			default: ["Espace personnel", "Compte de connexion", "Code d'invitation", "Déconnexion", "Solde",
				"Pièces d'or", "Portefeuille"
			],
			menu: ["Mes actifs", "Liste des équipes", "Lier un compte", "Détails du compte",
				"Présentation de la plateforme", "Déconnexion"
			]
		},
		bindAccount: {
			default: ["Lier un compte", "Soumettre"],
			fields: ["Nom du titulaire du compte", "Numéro de téléphone", "Compte bancaire", "Nom", "Type",
				"Adresse USDT"
			],
			placeholder: ["Entrez le nom du titulaire du compte", "Entrez le numéro de téléphone",
				"Entrez le numéro de compte bancaire", "Entrez le nom de la banque", "Sélectionnez le type USDT",
				"Entrez l'adresse USDT"
			]
		},
		bindAccount2: [
			"Veuillez confirmer que les informations sont exactes, sinon cela affectera les transactions normales.",
			"Lier immédiatement"
		],
		wallet: {
			default: ["Mes actifs", "Recharger", "Retirer", "Historique de recharge", "Historique de retrait",
				"Montant déjà rechargé", "Montant vendu", "Gains réalisés", "Solde du compte", "Solde",
				"Montant de recharge (USDT)", "Montant de vente",
				"Gains totaux", "Devenir marchand", "Pour devenir marchand, veuillez contacter le service client",
				"Confirmer l'inscription en tant que marchand", "Certification marchande", "Vous devez payer",
				"Justificatif de paiement", "Dépôt de garantie marchand", "Certification immédiate", "Informations",
				"Vous devez payer",
				"Solde insuffisant, voulez-vous recharger? "
			],
			label: ["Mode de retrait", "Montant de retrait", "Mot de passe financier", "Soumettre",
				"Numéro de téléphone", "Adresse e-mail", "IFSC", "Confirmer"
			],
			placeholder: ["Sélectionnez le mode de retrait", "Entrez le montant de retrait",
				"Entrez le mot de passe financier", "Sélectionnez le mode de retrait",
				"Entrez le numéro de téléphone du bénéficiaire", "Entrez l'adresse e-mail du bénéficiaire",
				"Entrez le IFSC du bénéficiaire"
			],
			msg: ["Vous n'avez pas encore défini de mot de passe financier, veuillez le définir d'abord",
				"Vous n'avez pas encore lié de compte PIX, veuillez d'abord lier un compte",
				"Voulez-vous confirmer le retrait?"
			]
		},
		recharge4: [
			"Pour votre sécurité financière, veuillez fournir une capture d'écran de la transaction réussie pour vérification !"
		],
		recharge: {
			default: ["Recharge portefeuille", "Pré-recharge portefeuille", "Mode de recharge", "Recharger",
				"Confirmer"],
			label: ["Catégorie", "Adresse", "Montant de la recharge", "Entrez le montant", "Télécharger une preuve",
				"Copié avec succès", "Pré-recharge Exchange"
			],
			placeholder: ["Sélectionnez la catégorie", "Entrez l'adresse"],
			info: ["Montant de la recharge", "Numéro de commande", "Banque bénéficiaire",
				"Numéro de compte bénéficiaire", "Bénéficiaire", "Copier"
			]
		},
		task: {
			tabs: ["Tout", "Liste de vente", "Expiré", "Terminé", "En attente du paiement du marchand",
				"En attente de confirmation"
			],
			default: ["Liste des commandes"],
			msg: ["Soumettre pour vérification", "Déjà soumis, veuillez patienter",
				"Soumission échouée, veuillez réessayer"
			]
		},
		userInfo: {
			default: ["Informations personnelles", "Avatar", "Compte", "E-mail", "Alipay", "Détails",
				"Modifier le mot de passe", "Mot de passe financier", "Cliquez pour définir", "Modifier l'avatar",
				"Modifier le mot de passe de connexion", "Modifier le mot de passe financier", "Soumettre",
				"Effacer le cache", "Voir les informations", "Pseudo", "Code d'invitation"
			],
			label: ["Ancien mot de passe de connexion", "Nouveau mot de passe de connexion",
				"Confirmer le mot de passe de connexion", "Ancien mot de passe financier",
				"Nouveau mot de passe financier", "Confirmer le mot de passe financier", "Enregistrer"
			],
			placeholder: ["Entrez l'ancien mot de passe de connexion", "Entrez le nouveau mot de passe de connexion",
				"Confirmez le nouveau mot de passe de connexion", "Entrez l'ancien mot de passe financier",
				"Entrez le nouveau mot de passe financier", "Confirmez le nouveau mot de passe financier"
			]
		},
		fundRecord: {
			default: ["Historique des dépenses", "Historique des recharges", "Journal des actifs", "Recharge",
				"Recevoir", "Dépenser"
			],
			tabs: ["Recevoir", "Dépenser", "Recharger"]
		},
		dialog: ["Avertissement", "Confirmer", "Soumission en cours...", "Copié avec succès",
			"La version iOS est trop ancienne et n'est pas prise en charge", "Enregistrement en cours...",
			"Chargement des données..."
		],
		serviceCenter: ["Centre d'assistance clientèle", "Salut, je suis un représentant du service clientèle dédié~",
			"Je suis heureux de vous aider", "Service en libre-service", "Chat en ligne", "Service de recharge",
			"Service Line"
		],
		userTaskRecord: ["Mes commandes", "Commandes de vente", "Commandes d'achat", "Statut actuel",
			"Commission gagnée", "Terminé"
		],
		withdrawlist: ["Historique des retraits"],
		teamReport: {
			default: ["Liste de l'équipe"]
		},
		common2: ["Guide pour débutants", "Contacter le service clientèle",
			"Conditions d'utilisation, voir les détails", "Service clientèle 1", "Service clientèle 2"
		],
		common3: ["Réussi", "Présentation de la plateforme"],
		invite: ["Partager et parrainer", "Mon code d'invitation",
			"Copiez le code d'invitation pour inviter plus d'amis à rejoindre", "Copier",
			"Impossible d'inviter temporairement des membres"
		],
		common4: ["Vérification d'identité réelle", "Soumis avec succès", "Remarques importantes",
			"Détails de la remarque", "Montant de la caution", "Numéro de carte d'identité", "Document financier",
			"Veuillez d'abord lier un compte", "Veuillez d'abord terminer la vérification d'identité réelle"
		],
		common5: ["Vendre", "minute(s)", "avant", "Sauvegarder le code QR", "Ouvrir",
			"Compte gelé, transaction temporairement indisponible", "Télécharger l'application"
		],
		common6: ["Commandes de recharge", "Numéro de commande", "Montant", "Heure", "Statut"],
		hall2: ["Le montant minimum de vente est de", "", "Nombre maximum de ventes dépassé pour aujourd'hui"],
		register2: ["Inscription par e-mail", "Inscription par téléphone portable",
			"Veuillez entrer votre numéro de téléphone portable"
		],
		withdraw2: ["Retrait", "Compte du vendeur", "Solde du compte", "Montant à payer", "Payer maintenant",
			"Vous devez terminer toutes les tâches avant de pouvoir effectuer un retrait",
			"Nombre maximum de retraits quotidiens dépassé", "Remarques"
		],
		mytask2: ["Compte du vendeur", "Prix", "Montant", "Solde du compte", "Montant à payer", "Temps d'appariement",
			"Détails de la commande", "La quantité ne peut pas être 0", "Solde insuffisant",
			"Le prix ne peut pas être 0", "Plage d'erreur"
		],
		taskOrder2: ["Vous avez des commandes en cours qui ne peuvent pas être annulées", "Solde insuffisant",
			"Confirmer", "Échec", "Vous devez terminer toutes les commandes avant de pouvoir effectuer un retrait:"
		],
		busAuth2: ["Mise à niveau du compte vendeur", "Je suis d'accord", "Confirmer la mise à niveau",
			"Mise à niveau du compte vendeur",
			"Contactez le service clientèle si vous devez modifier les informations de votre carte bancaire",
			"Votre compte doit être mis à niveau en compte vendeur"
		],
		recharge2: ["Le montant ne peut pas être 0", "Une capture d'écran est obligatoire pour la vérification"],
		buy3: ["Chronométrage", "Heure(s)", "Type", "Commande de bonus", "Commande de partage",
			"Nombre maximum de participants", "Laissez vide pour ne pas limiter le nombre de participants",
			"ID d'utilisateur spécifié", "Veuillez entrer l'ID spécifié"
		],
		hall3: ["Jours", "Heure(s)", "Minute(s)", "Seconde(s)", "Commande de partage", "Compte", "Date d'expiration"],
		sell3: ["Le prix de vente ne peut pas être supérieur au meilleur prix"],
		busAuth3: ["Membre", "Vendeur", "Vendeur de couronne"],
		recharge3: ["Calculer"],
		home3: ["Mineur", "Devinez", "Boîte aveugle", "Finance", "À venir"],
		home4: ["Transaction rapide", "Acheter USDT en un clic", "Transactions C2C", "Acheter / vendre USDT",
			"Utilisateurs en ligne", "Volume total des transactions (USDT) sur 24 heures"
		],
		common7: ["Si votre problème n'est pas résolu, veuillez contacter le service clientèle en ligne",
			"Contacter le service clientèle", "Cliquez pour discuter", "Paramètres", "Tous", "Inviter des amis",
			"Nombre de membres de l'équipe", "Nouveaux ajouts ce mois-ci", "Date d'inscription",
			"Nombre de sous-utilisateurs"
		],
		hall4: ["Votre identité", "Membre", "Informations de votre compte", "Transaction réussie",
			"Vous avez terminé avec succès", "Total", "Demande d'achat", "Vendre"
		],
		task3: ["Tout", "Non payé", "Payé"],
		my: ["Êtes-vous sûr de vouloir vous déconnecter?"]
	}
}