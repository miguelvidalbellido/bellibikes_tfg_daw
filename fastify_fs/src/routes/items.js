module.exports = async function (fastify, opts) {
    fastify.get('/', async function (request, reply) {
      // Obtener lista de items
      return [
        { id: 1, name: 'Item 1' },
        { id: 2, name: 'Item 2' },
      ];
    });
};
  