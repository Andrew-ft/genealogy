<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JST Genealogy Explorer</title>
    <style>
        :root { --primary: #2563eb; --bg: #f8fafc; --text: #1e293b; }
        body { font-family: sans-serif; background: var(--bg); color: var(--text); padding: 20px; }
        
        /* Breadcrumbs */
        .breadcrumbs { margin-bottom: 20px; padding: 10px; background: white; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
        .crumb { color: var(--primary); cursor: pointer; font-weight: bold; }
        .crumb:hover { text-decoration: underline; }
        .separator { margin: 0 8px; color: #94a3b8; }

        /* Tree Styles */
        .node-container { display: flex; flex-direction: column; align-items: center; gap: 20px; margin-top: 20px; }
        .node { padding: 15px 25px; background: white; border: 2px solid var(--primary); border-radius: 12px; 
                cursor: pointer; transition: transform 0.2s; text-align: center; min-width: 120px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .node:hover { transform: translateY(-3px); background: var(--primary); color: white; }
        .node .meta { font-size: 0.8rem; opacity: 0.8; margin-top: 5px; }

        .children-grid { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; width: 100%; border-top: 2px solid #e2e8f0; padding-top: 20px; }
        
        .empty-msg { color: #94a3b8; font-style: italic; }
    </style>
</head>
<body>

    <div class="breadcrumbs" id="breadcrumb-trail"></div>
    <div id="tree-display" class="node-container"></div>

    <script>
        
        const genealogyData = {
            id: 1, name: "User A (You)", depth: 0,
            children: [
                { id: 2, name: "User B", depth: 1, children: [
                    { id: 4, name: "User C", depth: 2, children: [] },
                    { id: 5, name: "User D", depth: 2, children: [
                        { id: 6, name: "User G", depth: 3, children: [] }
                    ]}
                ]},
                { id: 3, name: "User E", depth: 1, children: [] }
            ]
        };

        let currentPath = [genealogyData];

        function render() {
            const currentRoot = currentPath[currentPath.length - 1];
            
            // Render Breadcrumbs
            const bc = document.getElementById('breadcrumb-trail');
            bc.innerHTML = currentPath.map((node, index) => 
                `<span class="crumb" onclick="goToPath(${index})">${node.name}</span>`
            ).join('<span class="separator">/</span>');

            // Render Tree
            const display = document.getElementById('tree-display');
            display.innerHTML = `
                <div class="node">
                    <strong>${currentRoot.name}</strong>
                    <div class="meta">Network Size: ${countDownlines(currentRoot)}</div>
                </div>
                <div class="children-grid">
                    ${currentRoot.children.length > 0 ? 
                        currentRoot.children.map(child => `
                            <div class="node" onclick="drillDown(${child.id})">
                                ${child.name}
                                <div class="meta">Depth: ${child.depth}</div>
                            </div>
                        `).join('') : 
                        '<div class="empty-msg">No further downlines</div>'
                    }
                </div>
            `;
        }

        function drillDown(id) {
            const currentRoot = currentPath[currentPath.length - 1];
            const nextNode = currentRoot.children.find(c => c.id === id);
            if (nextNode) {
                currentPath.push(nextNode);
                render();
            }
        }

        function goToPath(index) {
            currentPath = currentPath.slice(0, index + 1);
            render();
        }

        function countDownlines(node) {
            let count = node.children.length;
            node.children.forEach(c => count += countDownlines(c));
            return count;
        }

        render();
    </script>
</body>
</html>