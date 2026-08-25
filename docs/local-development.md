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

**`/etc/hosts` inside WSL is regenerated on every boot and editing it there does nothing.** The name
has to resolve for the browser, and the browser is on Windows. Open Notepad **as Administrator**,
open `C:\Windows\System32\drivers\etc\hosts`, and add:

```
127.0.0.1  librewaternet.local
```

This is the same step `hawsedc.local` already needed, which is why that name works today and nothing
in this WSL filesystem explains how.

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
