const ctx = document.getElementById('salesChart').getContext('2d');
const gradient = ctx.createLinearGradient(0, 0, 0, 200);
gradient.addColorStop(0, 'rgba(94, 114, 228, 0.3)');
gradient.addColorStop(1, 'rgba(94, 114, 228, 0)');

const data = {
  labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov'],
  datasets: [
    {
      label: 'Sales',
      data: [50, 190, 160, 320, 260, 310, 270, 340],
      borderColor: '#5E72E4',
      backgroundColor: gradient,
      tension: 0.4,
      fill: true,
      pointRadius: 3,
      pointHoverRadius: 5,
      borderWidth: 3
    }
  ]
};

const options = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: { display: false },
    tooltip: {
      backgroundColor: 'rgba(17, 24, 39, 0.9)',
      titleColor: '#fff',
      bodyColor: '#fff',
      padding: 10,
      caretPadding: 6,
      cornerRadius: 8
    }
  },
  scales: {
    x: {
      grid: { display: false },
      ticks: { color: '#9CA3AF', font: { size: 12 } }
    },
    y: {
      grid: { color: 'rgba(156, 163, 175, 0.25)', drawBorder: false },
      ticks: { color: '#9CA3AF', font: { size: 12 }, beginAtZero: true }
    }
  }
};

new Chart(ctx, { type: 'line', data, options });

