<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>LaporBanjir — Konfirmasi</title>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: Georgia, 'Times New Roman', serif;
        background: #f4f1ea;
        color: #1a1a1a;
        padding: 40px 20px;
    }

    .wrap {
        max-width: 560px;
        margin: 0 auto;
    }

    .masthead {
        border-top: 4px solid #2f6b3a;
        border-bottom: 1px solid #1a1a1a;
        padding: 14px 0 10px;
        margin-bottom: 30px;
    }

    .masthead .agency {
        font-size: 11px;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        font-family: Arial, sans-serif;
        color: #555;
    }

    .masthead .title {
        font-size: 22px;
        font-weight: bold;
    }

    .status {
        font-family: Arial, sans-serif;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #2f6b3a;
        font-weight: bold;
        margin-bottom: 4px;
    }

    .status::before {
        content: "●";
        margin-right: 6px;
    }

    .subtitle {
        font-family: Arial, sans-serif;
        font-size: 13px;
        color: #666;
        margin-bottom: 26px;
    }

    .receipt {
        background: #fff;
        border: 1px solid #d8d2c4;
    }

    .row {
        padding: 16px 20px;
        border-bottom: 1px dashed #cfc8b6;
        display: flex;
        justify-content: space-between;
        align-items: baseline;
    }

    .row:last-child { border-bottom: none; }

    .row .k {
        font-family: Arial, sans-serif;
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #888;
    }

    .row .v {
        font-size: 17px;
        text-align: right;
        max-width: 65%;
    }

    .footer-note {
        font-family: Arial, sans-serif;
        font-size: 11px;
        color: #999;
        margin-top: 16px;
        line-height: 1.6;
    }

    a.back {
        display: inline-block;
        margin-top: 24px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        color: #8b2020;
        text-decoration: none;
        border-bottom: 1px solid #8b2020;
        padding-bottom: 2px;
    }

    a.back:hover { color: #6e1919; }
</style>
</head>
<body>
<div class="wrap">
    <div class="masthead">
        <div class="agency">BPBD Kabupaten Bandung</div>
        <div class="title">LaporBanjir</div>
    </div>

    <div class="status">Laporan Diterima</div>
    <p class="subtitle">Berikut ringkasan data yang telah Anda kirimkan.</p>

    <div class="receipt">
        <div class="row">
            <span class="k">Nama Pelapor</span>
            <span class="v">{{ $nama }}</span>
        </div>
        <div class="row">
            <span class="k">Lokasi</span>
            <span class="v">{{ $lokasi }}</span>
        </div>
        <div class="row">
            <span class="k">Tinggi Genangan</span>
            <span class="v">{{ $tinggi }} cm</span>
        </div>
    </div>

    <p class="footer-note">
        Data ini diproses sementara oleh sistem dan tidak disimpan ke basis data.
        Untuk laporan resmi, hubungi kantor BPBD setempat.
    </p>

    <a href="{{ route('lapor.form') }}" class="back">← Buat laporan lain</a>
</div>
</body>
</html>