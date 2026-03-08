export default {
	common: {
		yhk: "BankCard",
		txfs: "Way",
		mixRecharge: ["Si prega di inserire l'indirizzo email"],
		language: "Lingua",
		common: ["Assistenza online", "Annulla", "Conferma", "Annulla"],
		upload: ["Caricamento in corso...", "Formato errato", "Caricamento avvenuto con successo", "Caricamento fallito"],
		vanPull: ["Non ci sono più dati", "Nessun dato"],
		login: {
		  text: ["Lingua", "BITCOIN", "Accedi"],
		  label: ["Accesso in corso...", "Accedi"],
		  placeholder: ["Inserisci l'indirizzo email", "Inserisci la password di accesso"],
		  default: ["Non hai un account?", "Registrati subito", "Hai dimenticato la password?", "Hai dimenticato la password di accesso"],
		  codes: ["Account non esistente", "Password non corretta", "Account bloccato", "Errore"]
		},
		register: {
		  text: ["BITCOIN", "Invio codice in corso...", "Ottieni", "Registrazione in corso...", "Registrati"],
		  placeholder: ["Inserisci l'indirizzo email", "Inserisci il codice di verifica", "Inserisci la password di accesso", "Conferma la password", "Inserisci il codice di invito", "Le password non coincidono", "Inserisci il codice di verifica", "Email non valida"],
		  label: ["Hai già un account? {a} {line}", "Torna al login"],
		  codes: ["Account già esistente", "Codice di verifica mancante", "Codice di verifica errato", "Le password non coincidono", "Referente non esistente", "Errore"]
		},
		resetpwd: ["Password dimenticata", "Inserisci l'indirizzo email", "Inserisci il codice di verifica", "Ottieni", "Inserisci la nuova password", "Reimposta la password"],
		footer: ["Home", "Hall", "Ordini", "Il mio"],
		home: {
		  label: ["Benvenuto"],
		  broadcast: "Congratulazioni al membro {member} per diventare {grade}",
		  menu: ["Registro delle transazioni", "Guida per principianti", "Invita amici", "Assistenza online"],
		  noticeTitle: "Ultimi annunci",
		  msg: "Attività non disponibile",
		  video: "Video tutorial non disponibili"
		},
		hall: {
		  default: ["Hall delle transazioni", "Saldo", "Acquista", "Vendi", "Conferma vendita", "Elenco ordini", "Ordini di vendita", "Vendita ai commercianti", "In attesa", "Compra", "Vendi ora"],
		  list: ["Quantità", "Prezzo", "Non concluso", "Vendi USDT", "Inserisci quantità di USDT", "Importo ricevuto", "Limite", "Compra USDT", "Importo speso"],
		  kbip: ["Annulla", "Importo superato", "Deve essere nell'intervallo di importo"]
		},
		msglist: ["Elenco messaggi"],
		sell: {
		  placeholder: ["Inserisci il prezzo di vendita", "Inserisci la quantità di vendita"],
		  label: ["Saldo (USDT)", "Nome", "Numero di conto bancario", "Prezzo attuale (USDT)", "Miglior prezzo di vendita", "Prezzo di vendita", "Quantità di vendita", "Miglior prezzo", "Tutto", "Conferma vendita"]
		},
		buy: {
		  placeholder: ["Inserisci il prezzo di acquisto", "Inserisci la quantità di acquisto", "Importo minimo", "Importo massimo"],
		  label: ["Saldo (USDT)", "Nome", "Numero di conto bancario", "Prezzo attuale (USDT)", "Miglior prezzo di acquisto", "Prezzo di acquisto", "Quantità di acquisto", "Miglior prezzo", "Tutto", "Conferma acquisto", "Limite"]
		},
		user: {
		  default: ["Area personale", "Accedi", "Codice invito", "Esci", "Saldo", "Punti", "Portafoglio"],
		  menu: ["I miei asset", "Elenco squadra", "Associa account", "Dettagli account", "Presentazione piattaforma", "Esci"]
		},
		bindAccount: {
		  default: ["Associa account", "Invia"],
		  fields: ["Nome intestatario", "Numero di telefono", "Numero di conto bancario", "Nome della banca", "Tipo", "Indirizzo USDT"],
		  placeholder: ["Inserisci il nome dell'intestatario", "Inserisci il numero di telefono", "Inserisci il numero di conto bancario", "Inserisci il nome della banca", "Seleziona il tipo di USDT", "Inserisci l'indirizzo USDT"]
		},
		bindAccount2: ["Assicurati di inserire correttamente le informazioni, in caso contrario potrebbe influire sulle transazioni normali", "Associa ora"],
		wallet: {
		  default: ["I miei asset", "Deposito", "Prelievo", "Registro depositi", "Registro prelievi", "Importo depositato", "Importo venduto", "Guadagni totali", "Saldo account", "Saldo", "Importo deposito (USDT)", "Importo venduto",
		    "Guadagni totali", "Aggiorna a account commerciante", "Aggiorna a account commerciante, contatta l'assistenza", "Conferma registrazione come commerciante", "Certificazione commerciante", "Importo da pagare", "Certificato di pagamento", "Deposito di garanzia commerciante", "Certificazione immediata", "Informazioni", "Importo da pagare",
		    "Saldo insufficiente, effettuare un deposito?"
		  ],
		  label: ["Metodo di prelievo", "Importo del prelievo", "Password finanziaria", "Invia", "Numero di telefono", "Indirizzo email", "IFSC", "Conferma"],
		  placeholder: ["Seleziona il metodo di prelievo", "Inserisci l'importo del prelievo", "Inserisci la password finanziaria", "Seleziona il metodo di prelievo", "Inserisci il numero di telefono del beneficiario", "Inserisci l'indirizzo email del beneficiario", "Inserisci l'IFSC del beneficiario"],
		  msg: ["Non hai ancora impostato la password finanziaria, impostala prima", "Non hai ancora associato un account PIX, associane uno prima", "Sei sicuro di voler prelevare?"]
		},
		recharge4: ["Per la sicurezza dei tuoi fondi, dopo aver effettuato il trasferimento, invia lo screenshot del trasferimento completato per l'approvazione!"],
		recharge: {
		  default: ["Ricarica portafoglio", "Ricarica portafoglio anticipata", "Metodo di ricarica", "Ricarica", "Conferma"],
		  label: ["Categoria", "Indirizzo", "Importo ricarica", "Inserisci importo", "Carica prova di pagamento", "Copiato con successo", "Ricarica su piattaforma anticipata"],
		  placeholder: ["Categoria", "Indirizzo"],
		  info: ["Importo ricarica", "Numero ordine", "Banca beneficiaria", "Conto beneficiario", "Beneficiario", "Copia"]
		},
		task: {
		  tabs: ["Tutti", "Elenco vendite", "Scaduti", "Completati", "In attesa di pagamento del commerciante", "In attesa di conferma"],
		  default: ["Elenco ordini"],
		  msg: ["Invia per revisione", "Inviato, attendi la revisione", "Invio fallito, invia nuovamente"]
		},
		userInfo: {
		  default: ["Informazioni personali", "Avatar", "Account", "Email", "Alipay", "Informazioni dettagliate", "Modifica password", "Password finanziaria", "Clicca per impostare", "Modifica avatar", "Modifica password di accesso", "Modifica password finanziaria", "Invia",
		    "Svuota cache", "Visualizza informazioni", "Nickname", "Codice di invito"
		  ],
		  label: ["Vecchia password di accesso", "Nuova password di accesso", "Conferma password", "Vecchia password finanziaria", "Nuova password finanziaria", "Conferma password", "Salva"],
		  placeholder: ["Inserisci la vecchia password di accesso", "Inserisci la nuova password di accesso", "Conferma la password di accesso", "Inserisci la vecchia password finanziaria", "Inserisci la nuova password finanziaria", "Conferma la password finanziaria"]
		},
		fundRecord: {
		  default: ["Registro spese", "Registro ricariche", "Registro asset", "Ric.", "Entr.", "Usc."],
		  tabs: ["Entrate", "Uscite", "Ricariche"]
		},
		dialog: ["Avviso", "Conferma", "Invio in corso...", "Copia riuscita", "La versione di iOS è troppo bassa e non è supportata", "Registrazione in corso...", "Caricamento dati..."],
		serviceCenter: ["Centro assistenza", "Ciao, sono il tuo assistente dedicato~", "Sono qui per aiutarti", "Servizio self-service", "Assistenza online", "Assistenza ricariche", "Assistenza Line"],
		userTaskRecord: ["I miei ordini", "Ordini venduti", "Ordini acquistati", "Stato attuale", "Commissione guadagnata", "Completato"],
		withdrawlist: ["Registro prelievi"],
		teamReport: {
		  default: ["Elenco squadra"]
		},
		common2: ["Guida per principianti", "Contatta il servizio clienti", "Termini del servizio, visualizza dettagli", "Servizio clienti 1", "Servizio clienti 2"],
		common3: ["Successo", "Presentazione della piattaforma"],
		invite: ["Condividi e promuovi", "Il mio codice di invito", "Copia il codice di invito per invitare più amici", "Copia", "Impossibile invitare membri al momento"],
		common4: ["Verifica dell'identità", "Invio riuscito", "Avvertenze", "Contenuto dell'avvertenza", "Importo da pagare", "Documento d'identità", "Documento finanziario", "Completa prima il collegamento dell'account", "Completa prima la verifica dell'identità"],
		common5: ["Vendi", "minuti", "fa", "Salva il codice QR", "Apri", "Account bloccato, impossibile effettuare transazioni al momento", "Download dell'app"],
		common6: ["Ordini di ricarica", "Numero dell'ordine", "Importo", "Data", "Stato"],
		hall2: ["L'importo minimo di vendita è", "", "Numero di vendite superato il limite giornaliero"],
		register2: ["Registrazione tramite email", "Registrazione tramite cellulare", "Inserisci il numero di cellulare"],
		withdraw2: ["Prelievo", "Account del venditore", "Saldo dell'account", "Importo da pagare", "Paga ora", "Ci sono ancora attività da completare, impossibile prelevare al momento", "Limite giornaliero di prelievi superato", "Note"],
		mytask2: ["Account commerciante", "Prezzo", "Importo", "Saldo dell'account", "Importo da pagare", "Orario di abbinamento", "Dettagli dell'ordine", "La quantità non può essere zero", "Saldo insufficiente", "Il prezzo non può essere zero", "Intervallo errato"],
		taskOrder2: ["Hai ancora ordini non completati, impossibile annullare", "Saldo insufficiente", "Conferma", "Fallito", "Devi completare gli ordini prima di prelevare:"],
		busAuth2: ["Aggiornamento a commerciante", "Accetto", "Conferma l'aggiornamento", "Aggiornamento a commerciante", "Se devi modificare le informazioni della carta bancaria, contatta il servizio clienti", "Il tuo account attuale deve essere aggiornato a un account commerciante"],
		recharge2: ["L'importo non può essere zero", "È necessario caricare uno screenshot"],
		buy3: ["Conto alla rovescia", "ore", "Tipo", "Ordine bonus", "Ordine di vendita in comune", "Numero massimo", "Se non inserisci un numero, non ci sarà un limite", "ID utente specifico", "Inserisci l'ID specifico"],
		hall3: ["Giorni", "ore", "minuti", "secondi", "Ordine di vendita in comune", "Account", "Scaduto"],
		sell3: ["Il prezzo di vendita non può essere superiore al prezzo migliore"],
		busAuth3: ["Membro", "Commerciante", "Commerciante di alto livello"],
		recharge3: ["Calcola"],
		home3: ["Miniera", "Scommesse", "Scatola misteriosa", "Investimenti", "In arrivo"],
		home4: ["Trading rapido", "Acquista USDT con un clic", "Trading C2C", "Acquista e vendi USDT", "Utenti online", "Volume di trading delle ultime 24 ore (USDT)"],
		common7: ["Se non riesci a risolvere il tuo problema, contatta il servizio clienti online", "Contatta il servizio clienti", "Clicca per consultare", "Impostazioni", "Tutti", "Invita amici", "Numero di squadra", "Nuovi aggiunti questo mese", "Data di registrazione", "Numero di sottoposti"],
		hall4: ["La tua identità", "Membro", "Informazioni del tuo account", "Transazione completata con successo", "Hai completato con successo", "Prezzo totale", "Acquista", "Vendi"],
		task3: ["Tutti", "Non pagato", "Pagato"],
		my: ["Sei sicuro di voler uscire dal tuo account?"]
	}
}