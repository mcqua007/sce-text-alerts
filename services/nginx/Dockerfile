FROM nginx:1.13

# nginx configuration
COPY nginx.conf /etc/nginx
# # mark volume/s as externally mounted
# VOLUME ["/var/www", "/etc/nginx/conf.d", "/var/log/nginx"]

CMD ["/usr/sbin/nginx"]
