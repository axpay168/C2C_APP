export default {
	common: {
		yhk: "BankCard",
		txfs: "Way",
		mixRecharge: ["Please fill in your email address"],
		language: "Language",
		common: ["Online customer service", "Trun off a floating window", "Confirm", "Cancel"],
		upload: ["Uploading...", "Incorrect format", "Upload succeeded", "Upload failed"],
		vanPull: ["No more data", "No data"],
		login: {
			text: ["Language", "Crypto", "Login"],
			label: ["Please wait...", "Login now"],
			placeholder: ["Please enter your email address", "Please enter your login password"],
			default: ["No account?", "Register now", "Forgot your password?", "Forgot your login password"],
			codes: ["Account does not exist", "Password is incorrect", "Account is frozen", "Failed"]
		},
		register: {
			text: ["Crypto", "Verification code is sending...", "Click to get", "Registering...", "Sign up now"],
			placeholder: ["Please enter your email address", "Please enter verification code",
				"Please enter your password", "Please confirm your password", "Please enter the invitation code",
				"Two passwords are inconsistent", "Please enter verification code", "Invalid Email address"
			],
			label: ["Already have an account?{a} {line}", "Back to log in"],
			codes: ["Account has already exists", "No verification code", "Verification code is incorrect",
				"Two passwords do not match", "The recommender does not exist", "Failed"
			]
		},
		resetpwd: ["Forgot password", "Please enter email", "Please enter verification code", "Click to get",
			"Please enter password", "Reset password"
		],
		footer: ["Home", "Hall", "Order", "Mine"],
		home: {
			label: ["Welcome"],
			broadcast: "Congratulations member {member} on becoming {grade}",
			menu: ["Funding Log", "Tutorial for Beginners", "invite to register", "Contact Customer Service"],
			noticeTitle: "Latest Notice",
			msg: "Task unopened",
			video: "No video tutorials yet"
		},
		hall: {
			default: ["Trading center", "Balance", "I want to buy", "I want to sell", "Confirm to sell", "Order List",
				"Sell order", "Sell to merchant", "Pending order", "Buy", "Sell"
			],
			list: ["Amount", "Unit price", "Unfilled", "Sell USDT", "Please enter USDT amount", "Get the amount",
				"Amount", "Buy USDT", "Amount spent."
			],
			kbip: ["Revoke", "Exceeded amount", "Must be within the amount"]
		},
		msglist: ["Message List"],
		sell: {
			placeholder: ["Please enter the selling price", "Please enter the sold amount"],
			label: ["Balance(USDT)", "Name", "Bank Account", "Current price(USDT)", "Best purchase price",
				"Selling price", "Amount of USDT sold", "Best purchase price", "All", "Sold confirmed"
			]
		},
		buy: {
			placeholder: ["Please enter purchase price", "Please enter purchase amount", "Minimum amount",
				"Maximum amount"
			],
			label: ["Balance(USDT)", "Name", "Bank account", "Current price(USDT)", "Best purchase price",
				" Buying price", "Purchase amount", "Best purchase price", "All", "Purchase confirmed",
				"Balance limit"
			]
		},
		user: {
			default: ["Personal Center", "log in account", "Invitation code", "Sign out", "Balance", "Gold", "Wallet"],
			menu: ["My assets", "Team list", "Account binding", "Account details", "Platform introduction", "Sign out"]
		},
		bindAccount: {
			default: ["Bind account", "Submit"],
			fields: ["Account name", "Phone number", "Bank account", "Bank Name", "Type", "USDT Address", "Soft Code"],
			placeholder: ["Please enter the name of account", "Please enter phone number", "Please enter bank account",
				"Please enter the name of opening bank", "Please select USDT type", "Please enter USDT address"
			]
		},
		wallet: {
			default: ["My Assets", "Recharge", "Withdraw", "Recharge record", "Withdrawals record", "Recharged amount",
				"Sold amount", "Earned income", "Account balance", "Balance", "Recharge amount(USDT)",
				"Selling amount", "Total return", "Merchant", "Upgrade merchants, please contact customer service",
				"Confirm settled merchant", "Merchant authentication", "You need to pay", "Payment voucher",
				"Merchant deposit", "Authenticate now", "Information", "You need to pay",
				" whether to recharge for insufficient balance?"
			],
			label: ["Withdrawal method", "Withdrawal amount", "Fund password", "Submit", "Phone number", "Mail address",
				"IFSC", "Confirm"
			],
			placeholder: ["Choose withdrawal method", "Please enter withdrawal amount", "Please enter fund password",
				"Please select a withdrawal method", "Please enter phone number", "Please enter email address",
				"Please enter IFSC"
			],
			msg: ["You have not set the fund password, please set it first",
				"You have not bound your PIX account, please bind first", "Confirm to withdraw?"
			]
		},
		recharge: {
			default: ["Wallet recharge", "Wallet pre-charge", "Recharge method", "Recharge", "Confirm"],
			label: ["Type", "Address", "Recharge amount", "Enter amount", "Upload certificate", "Copy succeeded",
				"Exchange prepaid "
			],
			placeholder: ["Type", "Address"],
			info: ["Recharge amount", "Order number", "Collecting bank", "Collecting account", "Payee", "Copy"]
		},
		task: {
			tabs: ["All", "Sell list", "Expired", "Completed", "Waiting for merchant payment",
				"Waiting for confirmation"
			],
			default: ["Order List"],
			msg: ["Submit for review", "Submitted, please wait for review", "Submission failed, please resubmit"]
		},
		userInfo: {
			default: ["Personal Information", "Avatar", "Account number", "Mail address", "Alipay",
				"Detailed information", "Modify password", "Fund password", "Click settings", "Modify avatar",
				"Modify login password", "Modify fund password", "Submit", "Empty the cache", "View information",
				"Nick name", "Recommendation code"
			],
			label: ["Original login password", "New login password", "Confirm password", "Original fund password",
				"New fund password", "Confirm password", "Save"
			],
			placeholder: ["Please enter the original login password", "Please enter a new login password",
				"Please confirm the login password", "Please enter the original fund password",
				"Please enter new fund password", "Please confirm the fund password"
			]
		},
		fundRecord: {
			default: ["Expense record", "Recharge record", "Asset log", "Recharge", "Receipt", "Payment"],
			tabs: ["Income", "Expense", "Recharge"]
		},
		dialog: ["Tips", "Confirm", "Submitting...", "Copied successfully",
			"The IOS system version is low to not support", "Registering...", "Loading..."
		],
		serviceCenter: ["Customer Service", "Hi, I'm the exclusive customer service staff~", "Glad to serve you",
			"Self service", "Online customer service staff", "Customer service staff for recharge issues",
			"Customer service staff in LINE"
		],
		userTaskRecord: ["My Order", "Sell Order", "Buy order", "Current status", "Earned commissions", "Completed"],
		withdrawlist: ["Withdrawals record"],
		teamReport: {
			default: ["Team List"]
		},
		common2: ["Beginner tutorial", "Contact customer service", "Terms of service, View details",
			"Customer service staff 1", "Customer service staff 2"
		],
		common3: ["Success", "Platform introduction"],
		invite: ["Share promotion", "My invitation code", "Copy the invitation code, invite more friends to join",
			"Copy"
		],
		common4: ["Real-name authentication", "Submission successful", "Notes", "Content of matters", "Payment amount",
			"Front of ID card", "Financial certificate", "Please complete the account binding first",
			"Please complete the real-name authentication first"
		],
		common5: ["Sell", "minutes", "ago", "Save QR code", "Open", "Account frozen, unable to trade temporarily",
			"APP download"
		],
		common6: ["Recharge order", "Order number", "Amount", "Time", "Status"],
		hall2: ["The minimum sales amount is", "", "The number of sales exceeds the daily limit"],
		register2: ["Sign up with email", "Sign up with phone number", "Please enter a phone number"],
		withdraw2: ["Withdrawal", "Seller's account number", "Account balance", "Amount to be paid", "Pay immediately",
			"There are tasks that still have not been completed, unable to withdraw temporarily",
			"The number of daily withdrawals exceeded", "Remarks"
		],
		mytask2: ["Merchant account number", "Price", "Amount", "Account balance", "Payment amount", "Matching time",
			"Order details", "Quantity cannot be 0", "Insufficient balance", " Price cannot be 0", "Range error"
		],
		taskOrder2: ["You still have unfilled orders, cannot be cancelled", "Insufficient balance", "Confirmed",
			"Failed", "You still need to complete the order to withdraw:"
		],
		busAuth2: ["Merchant upgrade", "I agree", "Confirm the upgrade", "Merchant",
			"If you need to modify the bank card information, please contact customer service",
			"The current account needs to be upgraded to a merchant account"
		],
		recharge2: ["The amount cannot be 0", "A screenshot must be uploaded"],
		buy3: ["Countdown", "Hour", "Type", "Welfare Order", "Joint Selling Order", "Limited Number of People",
			"Do not enter unlimited number of people", "Specify user ID", "Please enter specified ID "
		],
		hall3: ["Day", "Hour", "Minute", "Second", "Joint Selling Order", "Account", "Expired"],
		sell3: ["The selling price cannot be more than the best price"],
		busAuth3: ["Member", "Merchant", "Crown Merchant"],
		recharge3: ["Calculation"],
		home3: ["Miner", "Guess", "Blind box", "Financial", "Coming soon"],
		home4: ["Quick trade", "Quick buy USDT", "C2C trade", "TransferUSDT", "Online", "24H Amount(USDT)"],
		common7: ["Contact service if have any questions", "Contact service", "Ask Help", "Setting", "All", "Invite",
			"MemberCount", "Month New", "Reg time", "下属人数"
		],
		hall4: ["Type", "Member", "Your account", "trade success", "complete successfly", "TotalAmount", "Buy", "Sell"],
		task3: ["All", "Not pay", "Paid"],
		my: ["Are sure to logout?"],
		bindAccount2: [
			"Confirm that the information is filled in correctly, otherwise the normal transaction will be affected",
			"Bind now"
		],
		recharge4: [
			"For the safety of your funds, after the transfer is successful, please submit the screenshot of successful transfer for review!"
		],
		resetpwd2: ["Mail", "Phone", "Note: the password is composed of 6 ~ 16 characters and is not case sensitive"]
	},
}