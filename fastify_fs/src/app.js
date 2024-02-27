const fastify = require('fastify')({ logger: true })
const cron = require('node-cron')
const { changeValueBattery, restartTimeAvailableUser } = require('./utils/tasks')

// Cron para cambiar el estado de la bateria
cron.schedule('*/30 * * * * *', () => {
  changeValueBattery()
})

// CRON para restablecer el timepo disponible diario
cron.schedule('0 0 * * *', () => {
  console.log("running a task every 10 second")
  restartTimeAvailableUser()
});

fastify.register(require('@fastify/cors'), { 
  origin: "*",
});

fastify.register(require('./routes'));

const start = async () => {
  try {
    await fastify.listen({ port: 3000, host: '0.0.0.0' });
    console.log(`server listening on ${fastify.server.address().port}`);
  } catch (err) {
    fastify.log.error(err);
    process.exit(1);
  }
};

start();
