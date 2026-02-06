<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JST Genealogy Explorer</title>
    <!-- Styles -->
    <link rel="stylesheet" href="/css/genealogy.css">
    <style>
    :root {
        --bg: #ffffff;
        --text: #000000;
        --border: #e5e7eb;
        --input-bg: #fafafa;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        background-color: var(--bg);
        color: var(--text);
        min-height: 100vh;
        padding: 20px;
    }

    header {
        padding: 20px 30px;
        margin-bottom: 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border);
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .header-title {
        font-size: 1.25rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: -0.025em;
    }

    .user-welcome {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 16px;
        background-color: var(--input-bg);
        font-size: 0.875rem;
        font-weight: 500;
    }

    .user-icon {
        width: 28px;
        height: 28px;
        background: var(--text);
        color: var(--bg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.75rem;
    }

    .logout-btn {
        padding: 10px 24px;
        background: var(--text);
        color: var(--bg);
        border: none;
        font-weight: 700;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
    }

    .logout-btn:hover {
        background: #333333;
    }

    .logout-btn:active {
        transform: scale(0.98);
    }

    .breadcrumbs {
        padding: 12px 0;
        margin-bottom: 30px;
        font-size: 0.75rem;
        text-transform: uppercase;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: var(--text);
        background: none !important;
        box-shadow: none !important;
    }

    #tree-display {
        padding: 30px;
        min-height: 500px;
        background-color: var(--input-bg);
    }

    .loading {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 400px;
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .loading::after {
        content: '';
        width: 40px;
        height: 40px;
        border: 2px solid var(--border);
        border-top: 2px solid var(--text);
        animation: spin 1s linear infinite;
        margin-top: 20px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Override genealogy.css styles for nodes and breadcrumbs */
    .node-container .node,
    .node-container .person-node,
    [class*="node"] {
        border: 1px solid var(--text) !important;
        background: var(--bg) !important;
        color: var(--text) !important;
    }

    .node-container .node-name,
    .node-container .person-name {
        color: var(--text) !important;
        background: transparent !important;
    }

    #breadcrumb-trail,
    #breadcrumb-trail * {
        color: var(--text) !important;
    }

    @media (max-width: 768px) {
        body {
            padding: 10px;
        }

        header {
            flex-direction: column;
            gap: 15px;
            padding: 15px;
            align-items: stretch;
        }

        .header-left {
            flex-direction: column;
            gap: 10px;
        }

        .user-welcome {
            justify-content: center;
        }

        .logout-btn {
            width: 100%;
        }

        #tree-display {
            padding: 20px;
        }
    }
    </style>
</head>

<body>
    <header>
        <div class="header-left">
            <div class="header-title">🌳 JST Genealogy Explorer</div>
            <div class="user-welcome">
                <div class="user-icon">
                    <?php 
                        $username = $_SESSION['username'] ?? 'User';
                        echo strtoupper(substr($username, 0, 1));
                    ?>
                </div>
                <span><?php echo htmlspecialchars($username); ?></span>
            </div>
        </div>
        <button class="logout-btn" onclick="handleLogout()">Logout</button>
    </header>

    <div class="breadcrumbs" id="breadcrumb-trail">Home</div>

    <div id="tree-display" class="node-container">
        <div class="loading">Loading your network...</div>
    </div>

    <!-- Js -->
    <script src="/js/genealogy.js"></script>
    <script>
    function handleLogout() {
        if (confirm('Are you sure you want to logout?')) {
            window.location.href = '/logout.php';
        }
    }
    </script>
</body>

</html>