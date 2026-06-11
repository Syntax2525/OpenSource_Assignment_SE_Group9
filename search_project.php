<?php
require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/config/db.php';

$results = [];
$searchKeyword = '';

if (isset($_GET['search'])) {
    $searchKeyword = trim($_GET['search'] ?? '');
    if ($searchKeyword !== '') {
        $keyword = '%' . $searchKeyword . '%';
        $stmt = $pdo->prepare('SELECT * FROM projects WHERE project_name LIKE ?');
        $stmt->execute([$keyword]);
        $results = $stmt->fetchAll();
    }
}

$pageTitle = 'Search Project';
require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="page-header">
        <div>
            <h1 class="page-title">Search Projects</h1>
            <p class="subtitle">Find a project by its name.</p>
        </div>
        <a class="button secondary" href="dashboard.php">Back to Dashboard</a>
    </div>

    <div class="card">
        <form method="GET" class="stacked-form">
            <label for="search">Project Name</label>
            <input id="search" type="text" name="search" value="<?= htmlspecialchars($searchKeyword, ENT_QUOTES, 'UTF-8') ?>" placeholder="Enter project name">
            <button type="submit">Search</button>
        </form>

        <?php if ($searchKeyword !== ''): ?>
            <?php if (count($results) > 0): ?>
                <div class="table-wrap" style="margin-top:1rem;">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Project Name</th>
                            <th>Status</th>
                        </tr>

                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td><?= (int) $row['id'] ?></td>
                                <td><?= htmlspecialchars($row['project_name'], ENT_QUOTES, 'UTF-8') ?></td>
                                <td><span class="status-pill"><?= htmlspecialchars($row['status'], ENT_QUOTES, 'UTF-8') ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else: ?>
                <div class="message">No matching projects found.</div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>