function chart(event) {
    const curr1s = Array.from(document.getElementsByClassName("curr1")).map(x => x.firstChild.textContent.trim());
    const curr2s = Array.from(document.getElementsByClassName("curr2")).map(x => x.firstChild.textContent.trim());
    const rates = Array.from(document.getElementsByClassName("rate")).map(x => parseFloat(x.firstChild.textContent.trim().replace(",", ".")));
    const dates = Array.from(document.getElementsByClassName("date")).map(x => x.firstChild.textContent.trim());

    const cfg = {
        type: 'line',
        data: {
            labels: dates,
            datasets: [{
                label: 'Átváltási árfolyam',
                data: rates,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
            }]
        },
        options: {
            animations: {
                tension: {
                    duration: 1000,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                    loop: false
                }
            },
            scales: {
                y: { // defining min and max so hiding the dataset does not change scale range
                    min: Math.min(rates),
                    max: Math.max(rates)
                }
            }
        }
    }

    const canvas = document.getElementById("chart");

    const myLineChart = new Chart(canvas, cfg);
    canvas.clientWidth = 400;
    canvas.clientHeight = 400;

}