    </main>

    <!-- Navigation Footer between Steps -->
    <?php if ($modulNumber >= 0): ?>
    <div class="container my-5">
        <div class="neu-card p-3 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <?php if ($modulNumber > 0 && isset($modules[$modulNumber - 1])): ?>
                    <a href="<?php echo $modules[$modulNumber - 1]['slug']; ?>" class="neu-btn neu-btn-sm">
                        <i class="bi bi-arrow-left me-1"></i> Sebelumnya: <?php echo $modules[$modulNumber - 1]['title']; ?>
                    </a>
                <?php else: ?>
                    <a href="../index.php" class="neu-btn neu-btn-sm">
                        <i class="bi bi-house-door me-1"></i> Kembali ke Menu Utama
                    </a>
                <?php endif; ?>
            </div>

            <div class="text-center">
                <span class="small fw-bold text-muted">
                    <?php echo ($modulNumber === 0) ? 'Langkah 00: Fondasi Root Direktori' : 'Langkah ' . $modulNumber . ' dari 12 Modul UKK'; ?>
                </span>
            </div>

            <div>
                <?php if ($modulNumber < 12 && isset($modules[$modulNumber + 1])): ?>
                    <a href="<?php echo $modules[$modulNumber + 1]['slug']; ?>" class="neu-btn neu-btn-sm neu-btn-primary">
                        Lanjut ke: <?php echo $modules[$modulNumber + 1]['title']; ?> <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                <?php else: ?>
                    <a href="../../index.php" class="neu-btn neu-btn-sm neu-btn-primary" target="_blank">
                        <i class="bi bi-trophy-fill text-warning me-1"></i> Uji Sistem Aplikasi Nyata
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Neumorphic Footer -->
    <footer class="neu-footer">
        <div class="container text-center">
            <div class="d-flex justify-content-center align-items-center gap-2 mb-2">
                <span class="neu-badge neu-badge-primary">
                    <i class="bi bi-code-slash me-1"></i> Panduan Praktik UKK Asisten Pengembang Web
                </span>
            </div>
            <p class="text-muted small mb-1">
                Didesain khusus untuk pembelajaran terstruktur siswa SMK & Pemula Web Development.
            </p>
            <p class="text-muted small mb-0" style="font-size: 0.75rem;">
                Taking Order Cafe System &bull; PHP Native 8.x &bull; MySQL PDO &bull; Soft UI Neumorphism
            </p>
        </div>
    </footer>

    <!-- Bootstrap 5 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Materi UKK JS -->
    <script src="<?php echo $baseMateriUrl; ?>assets/js/app.js"></script>
</body>
</html>
