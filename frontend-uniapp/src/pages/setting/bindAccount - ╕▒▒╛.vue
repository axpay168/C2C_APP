<template>
	<view class="Body">
		<view class="Main Site" style="overflow: visible;">
			<view class="van-nav-bar van-nav-bar--fixed">
				<view class="van-nav-bar__content">
					<view class="van-nav-bar__left"><i class="van-icon van-icon-arrow-left van-nav-bar__arrow"></i>
					</view>
					<view class="van-nav-bar__title van-ellipsis"></view>
				</view>
			</view>
			<!-- class="Site PageBox" -->
			<view style="background-color: #13171a;">
				<view class="van-nav-bar van-nav-bar--fixed">
					<view class="van-nav-bar__content">
						<view class="van-nav-bar__left" @click="back"><i
								class="van-icon van-icon-arrow-left van-nav-bar__arrow"></i></view>
						<view class="van-nav-bar__title van-ellipsis">{{common.bindAccount.default[0]}}</view>
					</view>
				</view>
				
				<view class="ScrollBox2">
					<!-- <form class="van-form"> -->

					<view class="box"
						v-if="langtype == 'chn' || langtype == 'jpn' || langtype == 'kor' || langtype == 'tha' || langtype == 'vnm' || langtype == 'sgp' || langtype == 'hkg' || langtype == 'ind' || langtype == 'mys'">
						<!-- //      'name': '', //开户姓名
						// 		'bank_name': '', //银行名称
						// 		'card_no': '', //银行账户
						// 		'mobile': '', //联系方式
						// 		'youbian': '', //邮政编码 -->

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label"><span>{{languages[langtype]['name']}}</span>
							</view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="name"
										:placeholder="languages[langtype]['name2']" class="van-field__control"></view>
							</view>
						</view>
					
						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label">
								<span>{{languages[langtype]['bank_name']}}</span></view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="bank_name"
										:placeholder="languages[langtype]['bank_name2']" class="van-field__control">
								</view>
							</view>
						</view>
						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label">
								<span>{{languages[langtype]['card_no']}}</span></view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="card_no"
										:placeholder="languages[langtype]['card_no2']" class="van-field__control">
								</view>
							</view>
						</view>

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label">
								<span>{{languages[langtype]['mobile']}}</span></view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="mobile"
										:placeholder="languages[langtype]['mobile2']" class="van-field__control"></view>
							</view>
						</view>

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label">
								<span>{{languages[langtype]['youbian']}}</span></view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="youbian"
										:placeholder="languages[langtype]['youbian2']" class="van-field__control">
								</view>
							</view>
						</view>
<view class="van-cell van-field">
							<view class="van-cell__title van-field__label">
								<span>USDT Address</span></view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="uaddress"
										placeholder="USDT Address" class="van-field__control">
								</view>
							</view>
						</view>

					</view>


					<view class="box"
						v-if="langtype == 'eng' || langtype == 'eur' || langtype == 'fra' || langtype == 'ger' || langtype =='rus' || langtype == 'ita'">

						<!-- // 英语 - English (eng)
						// 银行名称
						// IBAN账号
						// 全名
						// 姓氏
						// 名字
						// 国家
						// 州/区
						// 城市
						// 联系方式
						// 邮政编码
						eng: {
							'bank_name': 'Bank Name',
							'iban': 'IBAN Account',
							'aname': 'Full Name',
							'xings': 'Surname',
							'name': 'Given Name',
							'country': 'Country',
							'zhouq': 'State/Province',
							'city': 'City',
							'mobile': 'Contact Number',
							'youbian': 'Postal Code'
						}, -->

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label">
								<span>{{languages[langtype]['bank_name']}}</span></view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="bank_name"
										:placeholder="languages[langtype]['bank_name2']" class="van-field__control">
								</view>
							</view>
						</view>

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label"><span>{{languages[langtype]['iban']}}</span>
							</view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="iban"
										:placeholder="languages[langtype]['iban2']" class="van-field__control"></view>
							</view>
						</view>
						
						<!-- 'bank_name': 'Bank Name',
						'iban': 'IBAN Account',
						'aname': 'Full Name',
						'xings': 'Surname',
						'name': 'Given Name',
						'country': 'Country',
						'zhouq': 'State/Province',
						'city': 'City',
						'mobile': 'Contact Number',
						'youbian': 'Postal Code' -->

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label"><span>{{languages[langtype]['aname']}}</span>
							</view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="aname"
										:placeholder="languages[langtype]['aname2']" class="van-field__control"></view>
							</view>
						</view>

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label"><span>{{languages[langtype]['xings']}}</span>
							</view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="xingshi"
										:placeholder="languages[langtype]['xings2']" class="van-field__control"></view>
							</view>
						</view>

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label"><span>{{languages[langtype]['name']}}</span>
							</view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="name"
										:placeholder="languages[langtype]['name2']" class="van-field__control"></view>
							</view>
						</view>

						
						<!-- 'country': 'Country',
						'zhouq': 'State/Province',
						'city': 'City',
						'mobile': 'Contact Number',
						'youbian': 'Postal Code -->

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label">
								<span>{{languages[langtype]['country']}}</span></view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="guojia"
										:placeholder="languages[langtype]['country2']" class="van-field__control">
								</view>
							</view>
						</view>


						<!-- 'zhouq': 'State/Province',
						'citys': 'City',
						'mobile': 'Contact Number',
						'youbian': 'Postal Code' -->

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label"><span>{{languages[langtype]['zhouq']}}</span>
							</view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="zhou"
										:placeholder="languages[langtype]['zhouq2']" class="van-field__control"></view>
							</view>
						</view>

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label"><span>{{languages[langtype]['city']}}</span>
							</view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="citys"
										:placeholder="languages[langtype]['city2']" class="van-field__control"></view>
							</view>
						</view>

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label">
								<span>{{languages[langtype]['mobile']}}</span></view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="mobile"
										:placeholder="languages[langtype]['mobile2']" class="van-field__control"></view>
							</view>
						</view>

						<view class="van-cell van-field">
							<view class="van-cell__title van-field__label">
								<span>{{languages[langtype]['youbian']}}</span></view>
							<view class="van-cell__value van-field__value">
								<view class="van-field__body2"><input type="text" v-model="youbian"
										:placeholder="languages[langtype]['youbian2']" class="van-field__control">
								</view>
							</view>
						</view>
						
						<view class="van-cell van-field">
													<view class="van-cell__title van-field__label">
														<span>USDT Address</span></view>
													<view class="van-cell__value van-field__value">
														<view class="van-field__body2"><input type="text" v-model="uaddress"
																placeholder="USDT Address" class="van-field__control">
														</view>
													</view>
												</view>
						
						

					</view>


					<view style="line-height: 45px; color: rgb(204, 204, 204); text-align: left;">
						<view style="margin-left: 20px;">{{common.bindAccount2[0]}}</view>
					</view>
					<view style="text-align: center; margin-top: 20px; display: none;">
						<p class="btn">{{common.bindAccount2[1]}}</p>
					</view>
					<view style="line-height: 45px; color: rgb(204, 204, 204);">
						<view style="margin-left: 20px;">{{common.busAuth2[4]}}</view>
					</view>
					<view v-show="show" style="margin: 30px auto; width: 90%; text-align: center;"><button @click="tijiao"
							class="van-button van-button--default van-button--large van-button--round"
							style="color: rgb(255, 255, 255); background: #0076fa; border-color: #0076fa;">
							<view class="van-button__content"><span class="van-button__text"><span
										style="color: rgb(255, 255, 255);">{{common.bindAccount.default[1]}}</span></span>
							</view>
						</button></view>
					<!-- </form> -->
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				isshow: false,
				show:true,
				uaddress:'',
				
				//      'name': '', //开户姓名
				// 		'bank_name': '', //银行名称
				// 		'card_no': '', //银行账户
				// 		'mobile': '', //联系方式
				// 		'youbian': '', //邮政编码 
				iban:'',
				bank_name:'',
				card_no:'',
				name:'',
				bankname: '',
				realname: '',
				banknum: '',
				guojia: '',
				zhou: '',
				citys: '',
				xingshi: '',
				mingzi: '',
				dizhis: '',
				youbian: '',
				mobile: '',

				userinfo: [],
				isbind: 0,
				formlist: [],
				langtype: 'chn',
				languages: {
					// 中国 - China (chn)
					chn: {
						'name': '开户姓名',
						'bank_name': '银行名称',
						'card_no': '银行账户',
						'mobile': '联系方式',
						'youbian': '邮政编码',

						'name2': '请输入开户姓名',
						'bank_name2': '请输入银行名称',
						'card_no2': '请输入银行账户',
						'mobile2': '请输入联系方式',
						'youbian2': '请输入邮政编码'
					},
					// 日本 - Japan (jpn)
					jpn: {
						'name': '開戸氏名',
						'bank_name': '銀行名',
						'card_no': '銀行口座番号',
						'mobile': '連絡先',
						'youbian': '郵便番号',

						'name2': '口座名を入力してください',
						'bank_name2': '銀行名を入力してください',
						'card_no2': '口座番号を入力してください',
						'mobile2': '連絡先を入力してください',
						'youbian2': '郵便番号を入力してください'

					},
					// 韩国 - South Korea (kor)
					kor: {
						'name': '계좌명',
						'bank_name': '은행명',
						'card_no': '은행 계좌번호',
						'mobile': '연락처',
						'youbian': '우편 번호',

						'name2': '계좌 소유자 이름을 입력하세요',
						'bank_name2': '은행 이름을 입력하세요',
						'card_no2': '은행 계좌 번호를 입력하세요',
						'mobile2': '연락처를 입력하세요',
						'youbian2': '우편번호를 입력하세요'
					},
					// 泰国 - Thailand (tha)
					tha: {
						'name': 'ชื่อบัญชี',
						'bank_name': 'ชื่อธนาคาร',
						'card_no': 'หมายเลขบัญชีธนาคาร',
						'mobile': 'เบอร์ติดต่อ',
						'youbian': 'รหัสไปรษณีย์',

						'name2': 'โปรดป้อนชื่อผู้ถือบัญชี',
						'bank_name2': 'โปรดป้อนชื่อธนาคาร',
						'card_no2': 'โปรดป้อนหมายเลขบัญชีธนาคาร',
						'mobile2': 'โปรดป้อนหมายเลขติดต่อ',
						'youbian2': 'โปรดป้อนรหัสไปรษณีย์'
					},
					// 越南 - Vietnam (vnm)
					vnm: {
						'name': 'Họ và tên',
						'bank_name': 'Tên ngân hàng',
						'card_no': 'Số tài khoản ngân hàng',
						'mobile': 'Số điện thoại liên hệ',
						'youbian': 'Mã bưu điện',

						'name2': 'Vui lòng nhập tên chủ tài khoản',
						'bank_name2': 'Vui lòng nhập tên ngân hàng',
						'card_no2': 'Vui lòng nhập số tài khoản ngân hàng',
						'mobile2': 'Vui lòng nhập số điện thoại liên hệ',
						'youbian2': 'Vui lòng nhập mã bưu điện'
					},
					// 新加坡 - Singapore (sgp)
					sgp: {
						'name': 'Full Name',
						'bank_name': 'Bank Name',
						'card_no': 'Bank Account Number',
						'mobile': 'Contact Number',
						'youbian': 'Postal Code',

						'name2': 'Please enter the account holder name',
						'bank_name2': 'Please enter the bank name',
						'card_no2': 'Please enter the bank account number',
						'mobile2': 'Please enter the contact mobile number',
						'youbian2': 'Please enter the postal code'
					},
					// 香港 - Hong Kong (hkg)
					hkg: {
						'name': '開戶姓名',
						'bank_name': '銀行名稱',
						'card_no': '銀行帳號',
						'mobile': '聯繫方式',
						'youbian': '郵政編碼',

						'name2': '請輸入開戶姓名',
						'bank_name2': '請輸入銀行名稱',
						'card_no2': '請輸入銀行帳戶',
						'mobile2': '請輸入聯繫方式',
						'youbian2': '請輸入郵政編碼'
					},
					// 印度 - India (ind)
					ind: {
						'name': 'खाता धारक का नाम',
						'bank_name': 'बैंक का नाम',
						'card_no': 'बैंक खाता संख्या',
						'mobile': 'संपर्क विवरण',
						'youbian': 'पोस्टल पिन कोड',

						'name2': 'कृपया खाता नाम दर्ज करें',
						'bank_name2': 'कृपया बैंक का नाम दर्ज करें',
						'card_no2': 'कृपया बैंक खाता नंबर दर्ज करें',
						'mobile2': 'कृपया संपर्क संख्या दर्ज करें',
						'youbian2': 'कृपया पोस्ट कोड दर्ज करें'
					},
					// 马来西亚 - Malaysia (mys)
					mys: {
						'name': 'Nama Pemegang Akun',
						'bank_name': 'Nama Bank',
						'card_no': 'Nombor Akaun Bank',
						'mobile': 'Maklumat Hubungan',
						'youbian': 'Poskod',

						'name2': 'Sila masukkan nama akaun',
						'bank_name2': 'Sila masukkan nama bank',
						'card_no2': 'Sila masukkan nombor akaun bank',
						'mobile2': 'Sila masukkan nombor telefon',
						'youbian2': 'Sila masukkan poskod'
					},

					// 英语 - English (eng)
					// 银行名称
					// IBAN账号
					// 全名
					// 姓氏
					// 名字
					// 国家
					// 州/区
					// 城市
					// 联系方式
					// 邮政编码
					eng: {
						'bank_name': 'Bank Name',
						'iban': 'IBAN Account',
						'aname': 'Full Name',
						'xings': 'Surname',
						'name': 'Given Name',
						'country': 'Country',
						'zhouq': 'State/Province',
						'city': 'City',
						'mobile': 'Contact Number',
						'youbian': 'Postal Code',


						'bank_name2': 'Please enter the bank name',
						'iban2': 'Please enter the IBAN account number',
						'aname2': 'Please enter the full name',
						'xings2': 'Please enter the last name',
						'name2': 'Please enter the first name',
						'country2': 'Please enter the country',
						'zhouq2': 'Please enter the state/region',
						'city2': 'Please enter the city',
						'mobile2': 'Please enter the contact number',
						'youbian2': 'Please enter the postal code'
					},


					// 英语 - English (eng)
					// 银行名称
					// IBAN账号
					// 全名
					// 姓氏
					// 名字
					// 国家
					// 州/区
					// 城市
					// 联系方式
					// 邮政编码
					// eng: {
					// 	'bank_name2': '请输入银行名称',
					// 	'iban2': '请输入IBAN账号',
					// 	'aname2': '请输入全名',
					// 	'xings2': '请输入姓氏',
					// 	'name2': '请输入名字',
					// 	'country2': '请输入国家',
					// 	'zhouq2': '请输入州/区',
					// 	'city2': '请输入城市',
					// 	'mobile2': '请输入联系方式',
					// 	'youbian2': '请输入邮政编码'
					// }, 


					// 法国 - France (fra)
					fra: {
						'bank_name': 'Nom de la banque',
						'iban': 'Numéro de compte IBAN',
						'aname': 'Nom complet',
						'xings': 'Nom de famille',
						'name': 'Prénom',
						'country': 'Pays',
						'zhouq': 'État/Province',
						'city': 'Ville',
						'mobile': 'Numéro de contact',
						'youbian': 'Code postal',

						'bank_name2': 'Veuillez entrer le nom de la banque',
						'iban2': 'Veuillez entrer le numéro de compte IBAN',
						'aname2': 'Veuillez entrer le nom complet',
						'xings2': 'Veuillez entrer le nom de famille',
						'name2': 'Veuillez entrer le prénom',
						'country2': 'Veuillez entrer le pays',
						'zhouq2': 'Veuillez entrer le État/Province',
						'city2': 'Veuillez entrer le ville',
						'mobile2': 'Veuillez entrer le numéro de contact',
						'youbian2': 'Veuillez entrer le code postal'
					},
					// 德国 - Germany (ger)
					ger: {
						'bank_name': 'Bankname',
						'iban': 'IBAN-Konto',
						'aname': 'Vollständiger Name',
						'xings': 'Nachname',
						'name': 'Vorname',
						'country': 'Land',
						'zhouq': 'Bundesland/Region',
						'city': 'Stadt',
						'mobile': 'Kontakttelefon',
						'youbian': 'Postleitzahl',

						'bank_name2': 'Bitte geben Sie den Banknamen ein',
						'iban2': 'Bitte geben Sie die IBAN-Kontonummer ein',
						'aname2': 'Bitte geben Sie den vollständigen Namen ein',
						'xings2': 'Bitte geben Sie den Nachnamen ein',
						'name2': 'Bitte geben Sie den Vornamen ein',
						'country2': 'Bitte geben Sie das Land ein',
						'zhouq2': 'Bitte geben Sie den Staat/Bezirk ein',
						'city2': 'Bitte geben Sie die Stadt ein',
						'mobile2': 'Bitte geben Sie die Kontaktinformationen ein',
						'youbian2': 'Bitte geben Sie die Postleitzahl ein'
					},
					// 俄罗斯 - Russia (rus)
					rus: {
						'bank_name': 'Название банка',
						'iban': 'IBAN-счет',
						'aname': 'Полное имя',
						'xings': 'Фамилия',
						'name': 'Имя',
						'country': 'Страна',
						'zhouq': 'Регион/Область',
						'city': 'Город',
						'mobile': 'Контактный номер',
						'youbian': 'Почтовый индекс',

						'bank_name2': 'Пожалуйста, введите название банка',
						'iban2': 'Пожалуйста, введите номер счета IBAN',
						'aname2': 'Пожалуйста, введите полное имя',
						'xings2': 'Пожалуйста, введите фамилию',
						'name2': 'Пожалуйста, введите имя',
						'country2': 'Пожалуйста, введите страну',
						'zhouq2': 'Пожалуйста, введите регион/район',
						'city2': 'Пожалуйста, введите город',
						'mobile2': 'Пожалуйста, введите контактный номер',
						'youbian2': 'Пожалуйста, введите почтовый индекс'
					},
					// 意大利 - Italy (ita)
					ita: {
						'bank_name': 'Nome della banca',
						'iban': 'Numero di conto IBAN',
						'aname': 'Nome completo',
						'xings': 'Cognome',
						'name': 'Nome',
						'country': 'Paese',
						'zhouq': 'Regione',
						'city': 'Città',
						'mobile': 'Numero di contatto',
						'youbian': 'Codice postale',

						'bank_name2': 'Si prega di inserire il nome della banca',
						'iban2': 'Si prega di inserire il numero del conto IBAN',
						'aname2': 'Si prega di inserire il nome completo',
						'xings2': 'Si prega di inserire il cognome',
						'name2': 'Si prega di inserire il nome',
						'country2': 'Si prega di inserire il paese',
						'zhouq2': 'Si prega di inserire la provincia/regione',
						'city2': 'Si prega di inserire la città',
						'mobile2': 'Si prega di inserire il numero di contatto',
						'youbian2': 'Si prega di inserire il codice postale'
					},
					// 欧洲 - Europe (eur)
					eur: {
						'bank_name': 'Bank Name',
						'iban': 'IBAN Account',
						'aname': 'Full Name',
						'xings': 'Surname',
						'name': 'Given Name',
						'country': 'Country',
						'zhouq': 'State/Province',
						'city': 'City',
						'mobile': 'Contact Number',
						'youbian': 'Postal Code',

						'bank_name2': 'Please enter the bank name',
						'iban2': 'Please enter the IBAN account number',
						'aname2': 'Please enter the full name',
						'xings2': 'Please enter the last name',
						'name2': 'Please enter the first name',
						'country2': 'Please enter the country',
						'zhouq2': 'Please enter the state/region',
						'city2': 'Please enter the city',
						'mobile2': 'Please enter the contact number',
						'youbian2': 'Please enter the postal code'
					},
				}
			};
		},


		onLoad(options) {
			const {
				id
			} = options
			this.id = id
			this.getuserinfo()
		},

		onShow() {

			// var langsData = this.langs;
			this.langtype = this.$store.state.lang || 'eng';
			// console.log(this.langtype);

			// console.log(JSON.stringify(this.radioObj));
			// // this.radioObj[this.nameObj[this.type].radio];
			// console.log(JSON.stringify(this.languages));

		},

		methods: {

			getuserinfo() {
				const token = uni.getStorageSync('token')
				let that = this
				this.$u.api.index.getUserinfo(token).then(res => {
					this.userinfo = res.data
					console.log(this.userinfo)
					if (res.data.bank.length > 0) {
						//this.show=false;
						that.bank_name = res.data.bank[0].bank_name
							that.name = res.data.bank[0].name
						that.card_no = res.data.bank[0].card_no
						that.mobile = res.data.bank[0].mobile
						that.youbian = res.data.bank[0].youbian
						that.uaddress = res.data.bank[0].uaddress
						that.citys = res.data.bank[0].citys
						
						that.isbind = 1
					} else {
						that.isbind = 0
					}
				})
			},
			tijiao() {
				
					
				var token = uni.getStorageSync('token');
				if (this.isbind == 0) {
					var param = {
						'token':token,
						'name': this.name, //开户姓名
						'bank_name': this.bank_name, //银行名称
						'card_no': this.card_no, //银行账户
						'mobile': this.mobile, //联系方式
						'youbian': this.youbian, //邮政编码
						
					};
					
			this.$u.api.index.bind_bank(token,this.name,this.bank_name,this.card_no,this.mobile,this.youbian,this.uaddress).then(res => {
				this.$utils.showToast('succès')
				setTimeout(() => {
					this.back()
				}, 1000)
			})
				
					
				} else {
					
				
					
				
				
			this.$u.api.index.updete_bank(token,this.name,this.bank_name,this.card_no,this.mobile,this.youbian,this.uaddress,this.userinfo.bank[0].id).then(res => {
				this.$utils.showToast('succès')
				setTimeout(() => {
					this.back()
				}, 1000)
			})
					
			setTimeout(() => {
				this.$utils.showToast('succès')
			}, 1000)
					
					
				}
			},
			back() {
				const pages = getCurrentPages();
				if (pages.length === 2) {
					uni.navigateBack({
						delta: 1
					});
				} else if (pages.length === 1) {
					uni.switchTab({
						url: '/pages/index/index',
					})
				} else {
					uni.navigateBack({
						delta: 1
					});
				}
			},
			dumprun(url) {
				uni.navigateTo({
					url
				})
			},
		},
		computed: {
			common() {
				return this.$t("common")
			},
			//小玩法对应值
			radioObj() {
				let langtype = this.langtype
				var radioObj = {};

				if (langtype == 'chn' || langtype == 'jpn' || langtype == 'kor' || langtype == 'tha' || langtype ==
					'vnm' || langtype == 'sgp' || langtype == 'hkg' || langtype == 'ind' || langtype == 'mys') {
					radioObj = {
						'name': '', //开户姓名
						'bank_name': '', //银行名称
						'card_no': '', //银行账户
						'mobile': '', //联系方式
						'youbian': '', //邮政编码
					}
				}

				if (langtype == 'eng' || langtype == 'eur' || langtype == 'fra' || langtype == 'ger' || langtype ==
					'rus' || langtype == 'ita') {
					radioObj = {
						'name': '', //开户姓名
						'bank_name': '', //银行名称
						'card_no': '', //银行账户
						'mobile': '', //联系方式
						'youbian': '', //邮政编码
					}
				}

				return radioObj;
			}
		}
	}
</script>

<style>
	.ScrollBox {
		padding-top: 50px;
		/* padding: 0 !important; */
	}

	.ScrollBox2 {
		background-color: #13171a;
		padding-top: 50px;
		/* padding: 0 !important; */
	}

	.Site .van-nav-bar .van-icon {
		font-size: 1.5rem !important;
		color: #bbb !important;
	}

	.PageBox {
		color: #ccc;
		padding-top: 20px;
		background-color: #13171a
	}

	.PageBox .box {
		width: 95%;
		padding: 10px 0 10px 10px;
		font-size: 13px;
		margin-top: 15px;
		border-radius: 10px;
		margin-left: 10px;
		background-color: #191c23;
		color: #ccc
	}

	.van-nav-bar {
		background-color: #191c23
	}

	.van-viewider {
		margin: 0
	}

	.van-nav-bar .van-nav-bar__title {
		color: #ccc
	}

	.PageBox .van-cell {
		background-color: #191c23
	}

	.van-cell .van-cell__title {
		font-size: 16px;
		width: 130px;
		color: #ccc
	}

	.van-uploader .van-uploader__preview,
	.van-uploader .van-uploader__preview-image,
	.van-uploader .van-uploader__upload {
		margin: 0;
		background-color: #f7f8fa;
		border-radius: 8px
	}

	.van-field {
		font-weight: 700
	}

	.btn {
		width: 85%;
		padding: 10px 50px;
		border-radius: 20px;
		background-color: #0076fa;
		color: #000;
		font-size: 16px;
		text-align: center;
		margin: 15px 30px 30px
	}

	.van-field__body {
		display: flex;
		align-items: center;
	}

	.van-cell {
		background-color: #13171a;
		line-height: normal;
		border-bottom: 1px solid #e7e7e7;
	}
</style>