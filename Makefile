# Makefile for Tazwok.
#
PREFIX?=/usr
DOCDIR?=/usr/share/doc

all:

install:
	@echo "Installing Tazwok into $(PREFIX)/bin..."
	install -g root -o root -m 0777 tazwok $(PREFIX)/bin
	install -g root -o root -m 0644 examples/tazwok.conf /etc/slitaz
	install -g root -o root -m 0644 examples/config.site /etc
	@echo "Installing documentation files..."
	install -g root -o root -m 0755 -d $(DOCDIR)/tazwok
	install -g root -o root -m 0644 doc/* $(DOCDIR)/tazwok

uninstall:
	rm -f $(PREFIX)/bin/tazwok
	rm -f /etc/slitaz/tazwok.conf
	rm -f /etc/config.site
	rm -rf $(DOCDIR)/tazwok
