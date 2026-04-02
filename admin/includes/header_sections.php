<style>
  .header-section {
    background: linear-gradient(to right, #facc15, #3b82f6, #1e3a8a);
    color: white;
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  }

  .header-left {
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .header-left img {
    height: 3rem;
    width: auto;
    object-fit: contain;
  }

  .header-title {
    font-size: 1.25rem;
    font-weight: bold;
    letter-spacing: 0.5px;
  }

  .header-back-btn {
    background-color: #ffffff;
    color: #1e3a8a;
    font-weight: 600;
    padding: 0.5rem 1.25rem;
    border-radius: 9999px;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
  }

  .header-back-btn:hover {
    background-color: #facc15;
    color: #000;
  }

  @media (max-width: 640px) {
    .header-title {
      font-size: 1rem;
    }

    .header-back-btn {
      padding: 0.4rem 1rem;
      font-size: 0.875rem;
    }
  }
</style>

<header class="header-section">
  <div class="header-left">
    <src alt="Kasandigan Hub Logo" />
    <span class="header-title">POJECT K - ADMIN</span>
  </div>

  <a href="test.php" class="header-back-btn">
    ← Back to Dashboard
  </a>
</header>

