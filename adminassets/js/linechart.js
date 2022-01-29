new Chart(document.getElementById("linechart"), {
	type: 'line',
	data: {
		labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August', 'September', 'October', 'November', 'December' ],
		datasets: [{
			label: 'My First dataset',
			backgroundColor: window.chartColors.navy,
			borderColor: window.chartColors.navy,
			data: [4,4,3,4,5,6,7,8, 3, 5, 2, 3],
			fill: false,
		}, {
			label: 'My Second dataset',
			fill: false,
			backgroundColor: window.chartColors.purple,
			borderColor: window.chartColors.purple,
			data: [4,4,3,4,5,6,7,8, 3, 5, 2, 3],
		}]
	},
	options: {
		responsive: true,
		// title: {
		// 	display: true,
		// 	text: 'Chart.js Line Chart'
		// },
		tooltips: {
			mode: 'index',
			intersect: false,
		},
		hover: {
			mode: 'nearest',
			intersect: true
		},
		scales: {
			xAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Month'
				}
			}],
			yAxes: [{
				display: true,
				scaleLabel: {
					display: true,
					labelString: 'Value'
				}
			}]
		}
	}
});
