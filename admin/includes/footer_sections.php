<style>
  .footer-section {
    background: linear-gradient(to right, #1e3a8a, #3b82f6, #facc15);
    color: white;
    text-align: center;
    padding: 1rem;
    font-size: 0.875rem;
    box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
    margin-top: 2rem;
    position: relative;
    z-index: 10;
  }

  @media (max-width: 640px) {
    .footer-section {
      font-size: 0.75rem;
    }
  }
</style>

<footer class="footer-section">
  &copy; <?= date('Y') ?> ProyektoK Admin | All rights reserved.
</footer>
</body>
</html>
