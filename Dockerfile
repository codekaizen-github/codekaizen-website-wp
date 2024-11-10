FROM wordpress:latest AS base

COPY ./html /var/www/html

FROM base AS dev

# Install git
RUN apt-get update && apt-get install -y git

