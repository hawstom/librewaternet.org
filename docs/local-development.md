# Seeing this site before it is published

Two ways. The first needs nothing and takes five seconds; the second is the durable one and mirrors
how the real host will serve it.

## 1. The five-second look

```sh
cd ~/webdev/librewaternet.org && php -S 127.0.0.1:8791 -t .
```

Then open <http://127.0.0.1:8791/>. Ctrl-C stops it. Use this when the question is "does the page I
just edited look right".

**It is not a faithful preview of the real host in one way that has already bitten us:** PHP's
built-in server sends `Content-Type: text/html; charset=UTF-8`, and the live host sends no charset
at all. That is why every page must declare UTF-8 in its own first 1024 bytes and why `check.sh`
enforces it — a mis-declared page looks perfect here and breaks in public.

## 2. `librewaternet.local`, the durable one

Mirrors the planned production layout: this repository at the root, and the calculator suite under
`/engcalcs`, which on the real host will be a symlink (ROADMAP Task 479 in the engcalcs repo).
Locally it is an Apache `Alias`, which needs no `Options +FollowSymLinks`.

### Once, on the Linux side

The two vhost files live beside this document. Install and enable them:

```sh
sudo cp ~/webdev/librewaternet.org/docs/apache/librewaternet.conf \
        ~/webdev/librewaternet.org/docs/apache/librewaternet-ssl.conf \
        /etc/apache2/sites-available/
sudo a2ensite librewaternet librewaternet-ssl
sudo apache2ctl configtest && sudo systemctl reload apache2
```

### Once, on the Windows side

**This machine does NOT reach WSL at 127.0.0.1 by itself, and an earlier version of this document
was wrong to say so.** WSL2 sits behind a NAT whose address changes on every restart. What makes
`hawsedc.local` work is `C:\TGHFiles\Update-WSL2-IP.ps1`, run elevated at logon by Task Scheduler:
it writes a `127.0.0.1` hosts line and then points a **netsh port proxy** on `0.0.0.0:80` and
`:443` at whatever address WSL currently has. The hosts line is static; the proxy is the moving
part.

**Apache in WSL does name-based virtual hosting, so every hostname shares that one proxy.** A second
site therefore costs exactly one more name — no second proxy, no second port, no second script.
That script was generalised on 2026-08-25 from a single `$hostname` to a list:

```powershell
$hostnames = @("hawsedc.local", "librewaternet.local")
```

So there is nothing to add to Task Scheduler. **Run the script once** (elevated) so it rewrites the
hosts file now instead of at the next logon:

```powershell
powershell -ExecutionPolicy Bypass -File C:\TGHFiles\Update-WSL2-IP.ps1
```

**Two things worth knowing about the state it will repair.** The hosts file had
`172.21.0.1  hawsedc.local`, left by the script's own superseded version — 172.21.0.1 is the
WINDOWS end of the vEthernet adapter, which the script's comments already name as the original
defect. It worked only because the proxy listens on `0.0.0.0` and so answered that address too.
Running the script rewrites it to `127.0.0.1`. And the previous version stripped only its own
marker and its own hostname, so a hand-added second name would have survived the rewrite silently
and gone stale; the list is the fix for that too.

### The certificate

`https://librewaternet.local` uses a certificate signed by the **HawsEDC Local Dev CA** that already
exists at `~/.local/share/hawsedc-certs/`, so the browser that trusts `hawsedc.local` trusts this
one with no new trust decision. It was issued 2026-08-25 and runs ten years:

- `~/.local/share/hawsedc-certs/librewaternet.local.crt`
- `~/.local/share/hawsedc-certs/librewaternet.local.key`
- `~/.local/share/hawsedc-certs/lwn-ext.cnf` — the SAN list, if it ever needs reissuing.

**These are NOT in any repository and must not be.** A private key in git is a private key on GitHub.

## One thing that will surprise you locally

The landing page's buttons point at `https://hawsedc.com/engcalcs/...` — absolute production URLs.
So "Start a model" leaves your local site and goes to the live one. That is correct for the
published page and wrong for a local test of the link, and it is worth knowing before you conclude
the `Alias` is broken. Reach the local suite directly at
<https://librewaternet.local/engcalcs/Looped-Network.php>.
