# Makefile for Tazwok.
#
PREFIX?=/usr
DOCDIR?=/usr/share/doc
CHSCRIPTS?=/usr/lib/slitaz/chroot-scripts
WWWBB?=/usr/share/slitaz/web-bb

all:

install:
	@echo "Installing Tazwok into $(PREFIX)/bin..."
	install -g root -o root -m 0755 tazwok $(PREFIX)/bin
	install -g root -o root -m 0755 examples/tazwok.conf /etc/slitaz
	install -g root -o root -m 0755 examples/config.site /etc
	install -g root -o root -m 0755 examples/tazbb $(PREFIX)/bin
	@echo "Installing documentation files..."
	install -g root -o root -m 0755 -d $(DOCDIR)/tazwok
	install -g root -o root -m 0755 doc/* $(DOCDIR)/tazwok
	install -g root -o root -m 0755 applications $(PREFIX)/share
	@echo "Installing Chroot scripts..."
	install -g root -o root -m 0755 -d $(CHSCRIPTS)/tazwok
	install -g root -o root -m 0755 chroot-scripts/* $(CHSCRIPTS)/tazwok
	@echo "Installing web files..."
	install -g root -o root -m 0755 -d $(WWWBB)
	install -g root -o root -m 0755 web/* $(WWWBB)

uninstall:
	rm -f $(PREFIX)/bin/tazwok
	rm -f /etc/slitaz/tazwok.conf
	rm -f /etc/config.site
	rm -rf $(DOCDIR)/tazwok
