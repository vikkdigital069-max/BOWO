#!/usr/bin/php
<?php
// BOWO v1.0 PHP Web Panel - Alternative Interface
// Run: php bowo.php

function banner() { echo "\n╔══════════════════════════════════════════════════════════╗\n║     🔥 BOWO v1.0 PHP Web Panel | Kali Linux 🔥      ║\n╚══════════════════════════════════════════════════════════╝\n"; }

banner();
echo "\n[1] Start Web Server (Port 8080)\n[2] CLI Mode\nChoice: ";
$choice = trim(fgets(STDIN));

if ($choice == 1) {
    $html = '<!DOCTYPE html>
<html><head><title>BOWO PHP Panel</title><meta name="viewport" content="width=device-width,initial-scale=1">
<style>body{background:linear-gradient(135deg,#0a0e27,#1a1e3f);color:#00ff88;font-family:monospace;padding:20px}.container{max-width:900px;margin:0 auto}.header{text-align:center;border-bottom:2px solid #00ff88;padding:20px}.panel{background:rgba(0,0,0,0.5);border-radius:10px;padding:20px;margin:20px 0;border:1px solid #00ff88}input,select,textarea{width:100%;padding:10px;margin:10px 0;background:#1a1e3f;border:1px solid #00ff88;color:#00ff88;border-radius:5px}button{background:#00ff88;color:#0a0e27;padding:12px 24px;border:none;border-radius:5px;cursor:pointer;font-weight:bold}pre{background:#1a1e3f;padding:15px;border-radius:5px;overflow:auto}</style>
<body><div class="container"><div class="header"><h1>🔴 BOWO v1.0 PHP</h1><p>Security Toolkit | Web Interface</p></div>
<div class="panel"><h2>🌐 Network Scanner</h2><input type="text" id="scanTarget" placeholder="Target IP/Domain"><input type="text" id="scanPorts" placeholder="Ports" value="1-1000"><button onclick="runScan()">Start Scan</button><pre id="scanResult">Ready...</pre></div>
<div class="panel"><h2>🔓 System Info</h2><button onclick="getInfo()">Get System Info</button><pre id="infoResult">Click to get info</pre></div>
<script>
async function runScan(){let t=document.getElementById("scanTarget").value,p=document.getElementById("scanPorts").value;if(!t){alert("Enter target!");return;}document.getElementById("scanResult").innerText="Scanning...";let r=await fetch("api.php?action=scan&target="+encodeURIComponent(t)+"&ports="+encodeURIComponent(p));let d=await r.text();document.getElementById("scanResult").innerText=d;}
async function getInfo(){let r=await fetch("api.php?action=info");let d=await r.text();document.getElementById("infoResult").innerText=d;}
</script><footer style="text-align:center;margin-top:40px;padding:20px;color:#555">BOWO v1.0 | Created for Kali Linux</footer></div></body></html>';
    
    $api = '<?php
if($_GET["action"]=="scan"){ $t=$_GET["target"]; $p=$_GET["ports"]; echo shell_exec("nmap -p $p $t 2>/dev/null"); }
if($_GET["action"]=="info"){ echo "System: ".php_uname()."\nUptime: ".shell_exec("uptime"); }
?>';
    
    file_put_contents("/tmp/bowo_index.html", $html);
    file_put_contents("/tmp/api.php", $api);
    echo "\n[*] Server started at http://localhost:8080\n[*] Press Ctrl+C to stop\n";
    passthru("php -S 0.0.0.0:8080 -t /tmp/");
} else {
    echo "\n[*] Run 'node bowo.js' for full CLI mode\n";
}
