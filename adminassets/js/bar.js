new Chart(document.getElementById("barchart"), {
	type: 'bar',
	data: {
		labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August', 'September', 'October', 'November', 'December' ],
		datasets: [{
			data: [4,4,3,4,5,6,7,8, 3, 5, 2, 3],
			label: 'Dataset 1',
			backgroundColor: "#4755AB",
			borderWidth: 1,
		}, {
			data: [2,2,3,4,5,6,7,8, 3, 5, 2, 3],
			label: 'Dataset 2',
			backgroundColor: "#E7EDF6",
			borderWidth: 1,
		}]
	},
	options: {
		responsive: true,
		legend: {
			position: 'top',
		},
	}
});
