
# Mendefinisikan variabel untuk menyimpan nama branch saat ini
BRANCH_NAME := $(shell git rev-parse --abbrev-ref HEAD)

# Target contoh untuk menunjukkan bagaimana variabel digunakan
print-branch:
	@echo "Current branch is: $(BRANCH_NAME)"

run :
	@php spark serve

pull:
	git pull origin $(BRANCH_NAME)

push:
	git push origin $(BRANCH_NAME)

clear:
	@php spark cache:clear

# Rule untuk git pull dengan branch dinamis
pulls:
	@if [ -z "$(branch)" ]; then \
		if [ "$(filter pull,%)" != "pull" ]; then \
			echo "Error: Branch name is required. Usage: make pull branch_name"; \
			exit 1; \
		fi \
	fi
	git pull origin $(branch)

# Menangkap branch name dari argumen
branch=$(word 2,$(MAKECMDGOALS))

# Mencegah make salah menginterpretasi branch sebagai target
%:
	@:
