<?php
    session_start();
    if(!isset($_SESSION['nama'])){
        header('location: login.php');
    }
    require_once('./library/database.php');
    $id_user = $_SESSION['id'];
    $sqlMasuk = "SELECT SUM(jumlah) as total FROM transaksi 
        WHERE tipe='masuk' 
        AND id_user=".$id_user." AND MONTH(tanggal) = MONTH(NOW()) AND YEAR(tanggal) = YEAR(NOW())";
    $resultMasuk = $koneksi->query($sqlMasuk);
    $rowMasuk = $resultMasuk->fetch_assoc();
    $totalMasuk = $rowMasuk['total'] ?? 0;

    $sqlKeluar = "SELECT SUM(jumlah) as total FROM transaksi 
        WHERE tipe='keluar' 
        AND id_user=".$id_user." AND MONTH(tanggal) = MONTH (NOW()) AND YEAR(tanggal) = YEAR (NOW())";
    $resultKeluar = $koneksi->query($sqlKeluar);
    $rowKeluar = $resultKeluar->fetch_assoc();
    $totalKeluar = $rowKeluar ['total'] ?? 0;
    $saldo = $totalMasuk - $totalKeluar; 
//  $sqlGrafik = "SELECT DAY(tanggal) as hari, tipe, SUM(jumlah) as total 
//               FROM transaksi 
//               WHERE id_user=".$id_user." 
//               AND MONTH(tanggal) = MONTH(NOW()) 
//               AND YEAR(tanggal) = YEAR(NOW())
//               GROUP BY DAY(tanggal), tipe
//               ORDER BY DAY(tanggal)";
// $resultGrafik = $connection->query($sqlGrafik);

// $dataMasuk = array_fill(1, 31, 0);
// $dataKeluar = array_fill(1, 31, 0);

// while($row = $resultGrafik->fetch_assoc()){
//     if($row['tipe'] == 'masuk'){
//         $dataMasuk[$row['hari']] = (float)$row['total'];
//     } else {
//         $dataKeluar[$row['hari']] = (float)$row['total'];
//     }
// }

// $jsonMasuk = json_encode(array_values($dataMasuk));
// $jsonKeluar = json_encode(array_values($dataKeluar));//
?>
<html>
    <?php include('./library/header.php'); ?>
    <?php include('./library/navbar.php'); ?>
    <div class="container">
        <div class="welcome-section">
            <h1>Selamat Datang <span><?php echo $_SESSION['nama']; ?></span></h1>
        </div>
        <div class="summary-cards">
            <div class="card">
                <div class="card-icon masuk">↑</div>
                <div class="card-label">Total Pemasukan</div>
                <div class="card-value masuk">Rp <?php echo number_format($totalMasuk,0,',','.'); ?></div>
            </div>
            <div class="card">
                <div class="card-icon keluar">↓</div>
                <div class="card-label">Total Pengeluaran</div>
                <div class="card-value keluar">Rp <?php echo number_format($totalKeluar,0,',','.'); ?></div>
            </div>
            <div class="card">
                <div class="card-icon saldo">◈</div>
                <div class="card-label">Saldo Bulan Ini</div>
                <div class="card-value saldo">Rp <?php echo number_format($saldo,0,',','.'); ?></div>
            </div>
        </div>

        <!-- Grafik
<div class="chart-wrapper">
    <div class="chart-header">
        <div>
            <div class="chart-title">Tren Keuangan</div>
            <div class="chart-subtitle">Pemasukan & pengeluaran harian bulan ini</div>
        </div>
        <div class="chart-legend">
            <span class="legend-item masuk">● Pemasukan</span>
            <span class="legend-item keluar">● Pengeluaran</span>
        </div>
    </div>
    <canvas id="grafikKeuangan" height="100"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const labels = Array.from({length: 31}, (_, i) => i + 1);
    const dataMasuk = <?//php echo $jsonMasuk; ?>;
    const dataKeluar = <?//php echo $jsonKeluar; ?>;

    const ctx = document.getElementById('grafikKeuangan').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: dataMasuk,
                    borderColor: '#0d7a5f',
                    backgroundColor: 'rgba(13,122,95,0.08)',
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#0d7a5f',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Pengeluaran',
                    data: dataKeluar,
                    borderColor: '#b91c1c',
                    backgroundColor: 'rgba(185,28,28,0.06)',
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#b91c1c',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context){
                            return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    ticks: { font: { family: 'Manrope', size: 11 } }
                },
                y: {
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    ticks: {
                        font: { family: 'Manrope', size: 11 },
                        callback: function(value){
                            if(value >= 1000000) return 'Rp ' + (value/1000000).toFixed(1) + 'jt';
                            if(value >= 1000) return 'Rp ' + (value/1000).toFixed(0) + 'rb';
                            return 'Rp ' + value;
                        }
                    }
                }
            }
        }
    });
</script>-->
    </div>
    </body>
</html> 