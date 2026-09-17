    </main>

    <!-- Prev / Next Module Navigation (Jika sedang di halaman modul) -->
    <?php if (isset($modulNumber) && $modulNumber > 0): ?>
        <?php
        $prevNum = $modulNumber - 1;
        $nextNum = $modulNumber + 1;
        $prevMod = $modules[$prevNum] ?? null;
        $nextMod = $modules[$nextNum] ?? null;
        ?>
        <div class="container my-4">
            <div class="d-flex justify-content-between align-items-center">
                <?php if ($prevMod): ?>
                    <a href="<?php echo $prevMod['slug']; ?>" class="neu-btn">
                        <i class="bi bi-arrow-left"></i> <?php echo $prevMod['title']; ?>
                    </a>
                <?php else: ?>
                    <a href="../index.php" class="neu-btn">
                        <i class="bi bi-house"></i> Daftar Modul
                    </a>
                <?php endif; ?>

                <?php if ($nextMod): ?>
                    <a href="<?php echo $nextMod['slug']; ?>" class="neu-btn neu-btn-primary">
                        <?php echo $nextMod['title']; ?> <i class="bi bi-arrow-right"></i>
                    </a>
                <?php else: ?>
                    <a href="../index.php" class="neu-btn neu-btn-primary">
                        <i class="bi bi-check-circle"></i> Selesai Semua Modul
                    </a>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Neumorphic Footer -->
    <footer class="neu-footer">
        <div class="container text-center text-muted small">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
                <p class="mb-0">
                    <strong>Materi Edukasi UKK 2027</strong> &copy; Asisten Pengembang Web. Didesain dengan <strong>Light Neumorphism (Soft UI)</strong>.
                </p>
                <div>
                    <span class="neu-badge neu-badge-primary">
                        <i class="bi bi-code-slash me-1"></i> HTML5 + CSS Soft UI + PHP PDO
                    </span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- App Script -->
    <script src="<?php echo $baseMateriUrl; ?>assets/js/app.js"></script>
</body>
</html>
