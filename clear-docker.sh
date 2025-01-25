# Remover contêineres parados
docker container prune -f

# Remover imagens não utilizadas
docker image prune -a -f

# Remover volumes não utilizados
docker volume prune -f

# Remover redes não utilizadas
docker network prune -f

# Forçar a limpeza geral de todos os recursos não utilizados (incluindo volumes)
docker system prune -a --volumes -f

# Limpar cache de builds
docker builder prune --all -f

# Verificar o espaço em disco usado pelo Docker (opcional)
docker system df
