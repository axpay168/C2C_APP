export default {
	common: {
		yhk: "BankCard",
		txfs: "Way",
		mixRecharge: ["Bitte geben Sie Ihre E-Mail-Adresse ein"],
		language: "Sprache",
		common: ["Online-Kundendienst", "Schweben abbrechen", "Bestätigen", "Abbrechen"],
		upload: ["Hochladen läuft...", "Falsches Format", "Erfolgreich hochgeladen", "Hochladen fehlgeschlagen"],
		vanPull: ["Keine weiteren Daten verfügbar", "Keine Daten"],
		login: {
			text: ["Sprache", "BITCOIN", "Anmelden"],
			label: ["Anmeldung läuft...", "Jetzt anmelden"],
			placeholder: ["Bitte geben Sie Ihre E-Mail-Adresse ein", "Bitte geben Sie Ihr Passwort ein"],
			default: ["Kein Konto? ", "Jetzt registrieren", "Passwort vergessen?", "Passwort vergessen"],
			codes: ["Konto existiert nicht", "Falsches Passwort", "Konto gesperrt", "Fehler"]
		},
		register: {
			text: ["BITCOIN", "Bestätigungscode wird gesendet...", "Code erhalten", "Registrierung läuft...", "Jetzt registrieren"],
			placeholder: ["Bitte geben Sie Ihre E-Mail-Adresse ein", "Bitte geben Sie den Bestätigungscode ein", "Bitte geben Sie Ihr Passwort ein", "Bitte bestätigen Sie Ihr Passwort", "Bitte geben Sie den Einladungscode ein", "Passwörter stimmen nicht überein", "Bitte geben Sie den Bestätigungscode ein", "Ungültige E-Mail-Adresse"],
			label: ["Sie haben bereits ein Konto? {a} {line}", "Zurück zur Anmeldung"],
			codes: ["Konto existiert bereits", "Kein Bestätigungscode", "Falscher Bestätigungscode", "Passwörter stimmen nicht überein", "Empfehlungsgeber existiert nicht", "Fehler"]
		},
		resetpwd: ["Passwort vergessen", "Bitte geben Sie Ihre E-Mail-Adresse ein", "Bitte geben Sie den Bestätigungscode ein", "Code erhalten", "Bitte geben Sie ein neues Passwort ein", "Passwort zurücksetzen"],
		footer: ["Startseite", "Halle", "Bestellungen", "Mein Konto"],
		home: {
			label: ["Willkommen"],
			broadcast: "Herzlichen Glückwunsch an Mitglied {member}, Sie sind jetzt {grade}",
			menu: ["Fondsaufzeichnungen", "Anfängerleitfaden", "Einladung zur Registrierung", "Kontaktieren Sie den Kundenservice"],
			noticeTitle: "Neuste Ankündigung",
			msg: "Aufgabe nicht verfügbar",
			video: "Kein Videoleitfaden verfügbar"
		},
		hall: {
			default: ["Handelszentrum", "Guthaben", "Kauf", "Verkauf", "Verkauf bestätigen", "Bestellliste", "Verkaufsaufträge", "An Händler verkaufen", "In Auftrag geben", "Kaufen", "Verkaufen"],
			list: ["Menge", "Preis pro Einheit", "Nicht abgeschlossen", "USDT verkaufen", "Bitte geben Sie die Menge an USDT ein", "Erhaltener Betrag", "Kreditlimit", "USDT kaufen", "Betrag", "Gesamtbetrag"],
			kbip: ["Stornieren", "Überschrittener Betrag", "Muss innerhalb des Betragsbereichs liegen"]
		},
		msglist: ["Nachrichtenliste"],
		sell: {
			placeholder: ["Bitte geben Sie den Verkaufspreis ein", "Bitte geben Sie die Verkaufsmenge ein"],
			label: ["Guthaben (USDT)", "Name", "Bankkonto", "Aktueller Preis (USDT)", "Bester Verkaufspreis", "Verkaufspreis", "Verkaufsmenge", "Bester Preis", "Alle", "Verkauf bestätigen"]
		},
		buy: {
			placeholder: ["Bitte geben Sie den Kaufpreis ein", "Bitte geben Sie die Kaufmenge ein", "Mindestbetrag", "Höchstbetrag"],
			label: ["Guthaben (USDT)", "Name", "Bankkonto", "Aktueller Preis (USDT)", "Bester Kaufpreis", "Kaufpreis", "Kaufmenge", "Bester Preis", "Alle", "Kauf bestätigen", "Betrag"]
		},
		user: {
			default: ["Persönliches Zentrum", "Anmelden", "Einladungscode", "Abmelden", "Guthaben", "Goldmünzen", "Brieftasche"],
			menu: ["Mein Vermögen", "Teamliste", "Konto verknüpfen", "Kontodetails", "Plattformvorstellung", "Abmelden"]
		},
		bindAccount: {
			default: ["Konto verknüpfen", "Senden"],
			fields: ["Kontoinhaber", "Telefonnummer", "Bankkonto", "Name", "Typ", "USDT-Adresse"],
			placeholder: ["Bitte geben Sie den Kontoinhaber ein", "Bitte geben Sie die Telefonnummer ein", "Bitte geben Sie das Bankkonto ein", "Bitte geben Sie den Namen der Bank ein", "Bitte wählen Sie den USDT-Typ", "Bitte geben Sie die USDT-Adresse ein"]
		},
		bindAccount2: ["Bitte überprüfen Sie die eingegebenen Informationen. Falsche Angaben können zu Beeinträchtigungen beim Handel führen.", "Jetzt verknüpfen"],
		wallet: {
			default: ["Mein Vermögen", "Aufladen", "Abheben", "Aufladeverlauf", "Abhebeverlauf", "Bereits aufgeladener Betrag", "Bereits verkaufter Betrag", "Erhaltene Erträge", "Kontostand", "Guthaben", "Aufladebetrag (USDT)", "Verkaufspreis",
				"Gesamtertrag", "Als Händler aufsteigen", "Kontaktieren Sie den Kundenservice, um zum Händler aufzusteigen", "Bestätigen Sie die Händlerregistrierung", "Händlerauthentifizierung", "Zu zahlender Betrag", "Zahlungsnachweis", "Händler-Sicherheitsleistung", "Jetzt authentifizieren", "Informationen", "Zu zahlender Betrag",
				"Guthaben ist nicht ausreichend. Möchten Sie aufladen?"
			],
			label: ["Abhebemethode", "Abhebebetrag", "Geld-Passwort", "Absenden", "Telefonnummer", "E-Mail", "IFSC", "Bestätigen"],
			placeholder: ["Wählen Sie eine Abhebemethode", "Geben Sie den Abhebebetrag ein", "Geben Sie das Geld-Passwort ein", "Wählen Sie eine Abhebemethode aus", "Geben Sie die Telefonnummer des Empfängers ein", "Geben Sie die E-Mail-Adresse des Empfängers ein", "Geben Sie den IFSC-Code des Empfängers ein"],
			msg: ["Sie haben noch kein Geld-Passwort festgelegt. Bitte legen Sie zuerst eins fest", "Sie haben noch kein PIX-Konto verknüpft. Bitte verknüpfen Sie eins zuerst", "Sind Sie sicher, dass Sie abheben möchten?"]
		},
		recharge4: ["Zur Sicherheit Ihrer Mittel geben Sie nach erfolgreicher Überweisung bitte einen Screenshot der erfolgreichen Überweisung zur Überprüfung ab!"],
		recharge: {
			default: ["Wallet aufladen", "Vorabaufladung des Wallets", "Auflademethode", "Aufladen", "Bestätigen"],
			label: ["Kategorie", "Adresse", "Aufladebetrag", "Geben Sie den Betrag ein", "Laden Sie den Nachweis hoch", "Erfolgreich kopiert", "Vorabaufladungsbörse"],
			placeholder: ["Kategorie", "Adresse"],
			info: ["Aufladebetrag", "Bestellnummer", "Empfängerbank", "Empfängerkonto", "Empfänger", "Kopieren"]
		},
		task: {
			tabs: ["Alle", "Verkaufsliste", "Abgelaufen", "Abgeschlossen", "Warten auf Zahlung des Händlers", "Warten auf Bestätigung"],
			default: ["Bestellliste"],
			msg: ["Zur Überprüfung einreichen", "Bereits eingereicht, bitte warten Sie auf die Überprüfung", "Einreichung fehlgeschlagen, bitte erneut einreichen"]
		},
		userInfo: {
			default: ["Persönliche Informationen", "Profilbild", "Konto", "E-Mail", "Alipay", "Detailinformationen", "Passwort ändern", "Geld-Passwort", "Klicken Sie zur Einstellung", "Profilbild ändern", "Login-Passwort ändern", "Geld-Passwort ändern", "Absenden",
				"Cache leeren", "Informationen anzeigen", "Spitzname", "Empfehlungscode"
			],
			label: ["Altes Login-Passwort", "Neues Login-Passwort", "Passwort bestätigen", "Altes Geld-Passwort", "Neues Geld-Passwort", "Passwort bestätigen", "Speichern"],
			placeholder: ["Geben Sie Ihr altes Login-Passwort ein", "Geben Sie Ihr neues Login-Passwort ein", "Bestätigen Sie Ihr neues Login-Passwort", "Geben Sie Ihr altes Geld-Passwort ein", "Geben Sie Ihr neues Geld-Passwort ein", "Bestätigen Sie Ihr neues Geld-Passwort"]
		},
		fundRecord: {
			default: ["Expense Records", "Recharge Records", "Asset Logs", "Deposit", "Income", "Expense"],
			tabs: ["Income", "Expense", "Recharge"]
		},
		dialog: ["Prompt", "Confirm", "Submitting...", "Copy Successful", "Unsupported by iOS system with low version", "Registering...", "Loading Data..."],
		serviceCenter: ["Customer Service Center", "Hi, I'm your dedicated customer service.", "I'm glad to assist you.", "Self-Service", "Online Customer Service", "Recharge Customer Service", "Line Customer Service"],
		userTaskRecord: ["My Orders", "Sell Orders", "Buy Orders", "Current Status", "Commission Earned", "Completed"],
		withdrawlist: ["Withdrawal Records"],
		teamReport: {
			default: ["Team List"]
		},
		common2: ["Anfängerleitfaden", "Kundenservice kontaktieren", "Servicebedingungen anzeigen", "Kundendienst 1", "Kundendienst 2"],
		common3: ["Erfolgreich", "Plattformvorstellung"],
		invite: ["Freigeben und werben", "Mein Einladungscode", "Kopieren Sie den Einladungscode, um mehr Freunde einzuladen", "Kopieren", "Mitglieder können derzeit nicht eingeladen werden"],
		common4: ["Echtheitsprüfung", "Erfolgreich eingereicht", "Hinweise", "Informationen", "Zahlungsbetrag", "Ausweisdokument", "Finanznachweis", "Bitte schließen Sie zuerst die Kontobindung ab", "Bitte führen Sie zuerst die Echtheitsprüfung durch"],
		common5: ["Verkaufen", "Minuten", "vor", "QR-Code speichern", "Öffnen", "Das Konto ist gesperrt und derzeit nicht für den Handel verfügbar", "App herunterladen"],
		common6: ["Einzahlungsauftrag", "Auftragsnummer", "Betrag", "Zeit", "Status"],
		hall2: ["Der Mindestverkaufsbetrag beträgt", "", "Die Anzahl der Verkäufe pro Tag wurde überschritten"],
		register2: ["Registrierung per E-Mail", "Registrierung per Telefon", "Geben Sie Ihre Telefonnummer ein"],
		withdraw2: ["Abhebung", "Verkäuferkonto", "Kontostand", "Zu zahlender Betrag", "Jetzt bezahlen", "Aufgrund ausstehender Aufgaben ist derzeit keine Abhebung möglich", "Die Anzahl der täglichen Abhebungen wurde überschritten", "Bemerkungen"],
		mytask2: ["Händlerkonto", "Preis", "Betrag", "Kontoguthaben", "Zu zahlender Betrag", "Match-Zeit", "Auftragsdetails", "Die Anzahl darf nicht 0 sein", "Unzureichendes Guthaben", "Der Preis darf nicht 0 sein", "Ungültiger Bereich"],
		taskOrder2: ["Sie haben noch ausstehende Bestellungen und können sie nicht stornieren", "Unzureichendes Guthaben", "Bestätigen", "Fehlgeschlagen", "Sie müssen Ihre Bestellungen abschließen, um eine Abhebung vornehmen zu können:"],
		busAuth2: ["Händler-Upgrade", "Ich stimme zu", "Upgrade bestätigen", "Händlerkonto upgraden", "Bitte kontaktieren Sie den Kundendienst, um die Bankinformationen zu ändern", "Das aktuelle Konto muss zu einem Händlerkonto hochgestuft werden"],
		recharge2: ["Der Betrag darf nicht 0 sein", "Sie müssen einen Screenshot hochladen"],
		buy3: ["Countdown", "Stunden", "Typ", "Bonus-Bestellung", "Gemeinsame Verkaufsbestellung", "Beschränkung der Anzahl der Teilnehmer", "Geben Sie eine spezifische Benutzer-ID ein"],
		hall3: ["Tage", "Stunden", "Minuten", "Sekunden", "Gemeinsame Verkaufsbestellung", "Konto", "Abgelaufen"],
		sell3: ["Der Verkaufspreis darf den optimalen Preis nicht überschreiten"],
		busAuth3: ["Mitglied", "Händler", "Kronen-Händler"],
		recharge3: ["Berechnen"],
		home3: ["Mining-Maschine", "Wettvorhersage", "Blindbox", "Vermögensverwaltung", "Demnächst verfügbar"],
		home4: ["Schneller Handel", "USDT mit einem Klick kaufen", "C2C-Handel", "USDT kaufen und verkaufen", "Online-Benutzer", "24-Stunden-Handelsvolumen (USDT)"],
		common7: ["Wenn Ihr Problem nicht gelöst wurde, kontaktieren Sie bitte den Online-Kundendienst", "Kontaktieren Sie den Kundenservice", "Klicken Sie hier für eine Beratung", "Einstellungen", "Alle", "Freunde einladen", "Teammitglieder", "Neue Mitglieder in diesem Monat", "Registrierungszeit", "Untergebene"],
		hall4: ["Ihre Identität", "Mitglied", "Ihre Kontoinformationen", "Transaktion erfolgreich", "Sie haben erfolgreich abgeschlossen", "Gesamtpreis", "Kauf", "Verkauf"],
		task3: ["Alle", "Nicht bezahlt", "Bezahlt"],
		my: ["Möchten Sie sich wirklich abmelden?"]
	}
}