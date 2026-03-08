const textColorDark = '#929AA5'
const gridColorDark = '#555555'
const axisLineColorDark = '#333333'
const crossTextBackgroundColorDark = '#373a40'
const crossLineColorDark = '#aaaaaa'

const textColorLight = '#76808F'
const gridColorLight = '#ededed'
const axisLineColorLight = '#DDDDDD'
const crossTextBackgroundColorLight = '#686d76'
const crossLineColorLight = '#333333'

export default function(theme) {
	const textColor = theme === 'dark' ? textColorDark : textColorLight
	const gridColor = theme === 'dark' ? gridColorDark : gridColorLight
	const axisLineColor = theme === 'dark' ? axisLineColorDark : axisLineColorLight
	const crossLineColor = theme === 'dark' ? crossLineColorDark : crossLineColorLight
	const crossTextBackgroundColor = theme === 'dark' ? crossTextBackgroundColorDark : crossTextBackgroundColorLight
	return {
		grid: {
			horizontal: {
				color: gridColor
			},
			vertical: {
				color: gridColor
			}
		},
		candle: {
			bar: {
				upColor: '#EF5350',
				downColor: '#26A69A',
				noChangeColor: '#888888'
			},
			priceMark: {
				high: {
					color: textColor
				},
				low: {
					color: textColor
				},
				last:{
					upColor: '#EF5350',
					downColor: '#26A69A',
				}
			},
			tooltip: {
				showRule:'follow_cross',
				labels: ['Time:   ', 'Open:  ', 'Close: ', 'High:  ', 'Low:  ','Vol:  '],
				text: {
					color: textColor,
				},
				showType:'rect',
				rect:{
					offsetTop: 24,
					borderColor: '#3f4254',
					backgroundColor: 'rgba(17, 17, 17, .3)'
				}
			}
		},
		technicalIndicator: {
			bar: {
				upColor: '#EF5350',
				downColor: '#26A69A',
				noChangeColor: '#888888'
			},
			tooltip: {
				showParams: false,
			},
			circle:{
				upColor: '#EF5350',
				downColor: '#26A69A',
				noChangeColor: '#888888'
			}
		},
		xAxis: {
			axisLine: {
				color: axisLineColor
			},
			tickLine: {
				color: axisLineColor
			},
			tickText: {
				color: textColor
			}
		},
		yAxis: {
			axisLine: {
				color: axisLineColor
			},
			tickLine: {
				color: axisLineColor
			},
			tickText: {
				color: textColor
			}
		},
		separator: {
			color: axisLineColor
		},
		crosshair: {
			horizontal: {
				line: {
					color: crossLineColor
				},
				text: {
					backgroundColor: crossTextBackgroundColor
				}
			},
			vertical: {
				line: {
					color: crossLineColor
				},
				text: {
					backgroundColor: crossTextBackgroundColor
				}
			}
		}
	}
}
