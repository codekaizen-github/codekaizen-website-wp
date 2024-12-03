FROM wordpress:latest AS base

FROM base AS dev

# Install git
RUN apt-get update && apt-get install -y git

# Copy HTML files
COPY ./html /var/www/html

# Install WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    chmod +x wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/wp

# # Install WPGraphQL plugin
# RUN curl -O https://github.com/wp-graphql/wp-graphql/releases/latest/download/wp-graphql.zip && \
#     wp plugin install wp-graphql.zip --activate --allow-root && \
#     rm wp-graphql.zip
