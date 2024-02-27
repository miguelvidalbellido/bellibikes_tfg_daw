const factures = require('./factures')

module.exports = async function (fastify, opts) {
  fastify.register(factures, { prefix: '/factures' });
};