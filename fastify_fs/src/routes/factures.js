const {
    getLastFactureOfClient,
} = require('../controllers/facturesController')


module.exports = async function (fastify, opts) {
    fastify.get('/lastFactureClient/:id', getLastFactureOfClient)
}