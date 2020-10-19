INSTALL_PATH := "/Applications/XAMPP/htdocs/dashboard"

.PHONY: install install-example

install:
	cp -RP src/* $(INSTALL_PATH)

install-example:
	cp -RP examples/* $(INSTALL_PATH)
