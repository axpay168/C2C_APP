import Vue from "vue"
// i18n部分的配置
// 引入语言包，注意路径


// 越南 - Vietnam (vnm)
// 新加坡 - Singapore (sgp)
// 香港 - Hong Kong (hkg)
// 法国 - France (fra)

// 德国 - Germany (ger)
// 俄罗斯 - Russia (rus)
// 印度 - India (ind)
// 马来西亚 - Malaysia (mys)
// 意大利 - Italy (ita)
// 欧洲 - Europe (eur)


import en from './eng.js';//英文

// 中国 - China (chn)
// 日本 - Japan (jpn)
// 韩国 - South Korea (kor)
// 英语 - English (eng)
// 泰国 - Thailand (tha)
import chn from './chn.js';//中国
import jpn from './jpn.js';//日本
import kor from './kor.js';//韩国
import eng from './eng.js';//英文
import tha from './tha.js';//泰国
// 越南 - Vietnam (vnm)
// 新加坡 - Singapore (sgp)
// 香港 - Hong Kong (hkg)
// 法国 - France (fra)
import vnm from './vnm.js';//越南
import sgp from './eng.js';//新加坡
import hkg from './hkg.js';//香港
import fra from './fra.js';//法国
// 德国 - Germany (ger)
// 俄罗斯 - Russia (rus)
// 印度 - India (ind)
// 马来西亚 - Malaysia (mys)
// 意大利 - Italy (ita)
// 欧洲 - Europe (eur)
import ger from './ger.js';//德国
import rus from './rus.js';//俄罗斯
import ind from './ind.js';//印度
import mys from './mys.js';//马来西亚
import ita from './ita.js';//意大利
import eur from './eng.js';//欧洲 英文

// import hkg from './hkg.js';//香港
// import th from './th.js';
// import kor from './kor.js';
// import fra from './fra.js';
// import spa from './spa.js';

// VueI18n
import VueI18n from '@/common/vue-i18n.min.js';

// VueI18n
Vue.use(VueI18n);

const i18n = new VueI18n({
	// 默认语言
	locale: uni.getStorageSync('lang') || 'eng',
	// 引入语言文件
	messages: {
		// 'en':eng,//英语
		'chn':chn,//中文
		'jpn':jpn,//日本
		'kor':kor,//韩国
		'eng':eng,//英语
		'tha':tha,//泰国
		'vnm':vnm,//越南
		'sgp':sgp,//新加坡
		'hkg':hkg,//香港
		'fra':fra,//法国
		'ger':ger,//德国
		'rus':rus,//俄罗斯
		'ind':ind,//印度
		'mys':mys,//马来西亚
		'ita':ita,//意大利
		'eur':eur//欧洲 
	}
});


export default i18n