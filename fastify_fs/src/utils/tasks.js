const { getProducts } = require("./petitions");

require("dotenv").config();
const { Pool } = require("pg");

const pool = new Pool({
  host: process.env.DB_HOST,
  user: process.env.DB_USER,
  password: process.env.DB_PASS,
  database: process.env.DB_NAME,
  port: process.env.DB_PORT,
});

const changeValueBattery = async () => {
  console.log("Cada 30 segundos");

  try {
    const res = await pool.query("SELECT * FROM stations_bike");
    const bikes = res.rows;

    bikes.map((bike) => {
      const batery = bike.batery;

      if (bike.status === "RENTED") {
        const valorNumerico = parseInt(batery, 10) - 2;
        const nuevoValor = `${valorNumerico} %`;
        valorNumerico >= 0
          ? pool.query("UPDATE stations_bike SET batery = $1 WHERE id = $2", [
              nuevoValor,
              bike.id,
            ])
          : undefined;
      }

      if (bike.status === "NOT_RENTED") {
        const valorNumerico = parseInt(batery, 10) + 2;
        const nuevoValor = `${valorNumerico} %`;
        valorNumerico <= 100
          ? pool.query("UPDATE stations_bike SET batery = $1 WHERE id = $2", [
              nuevoValor,
              bike.id,
            ])
          : undefined;
      }
    });
  } catch (err) {
    console.error(err);
  }
};

const restartTimeAvailableUser = async () => {
  console.log("Todos los días a las 00:00");
  const productsData = await getProducts();

  try {
    const res = await pool.query(
      "SELECT up.* FROM users_plan up WHERE up.datetime_finish >= CURRENT_DATE"
    );

    if (!res || !Array.isArray(res.rows)) {
      console.error("res.rows no es un array o res no está definido");
      return;
    }

    const usersPlan = Array.from(res.rows);

    if (!Array.isArray(productsData)) {
      console.error("productsData no está definido o no es un array");
      return;
    }

    usersPlan.map((userPlan) => {
        const durationPlan = productsData
            .filter((product) => product.idproducto === userPlan.productIdFs)
            .map((productSelected) => productSelected.codfamilia);

        (userPlan.available_time != durationPlan) 
        ? pool.query("UPDATE users_plan SET available_time = $1 WHERE id = $2", [ durationPlan.at(0),userPlan.id, ])
        : undefined
    });
  } catch (err) {
    console.error(err);
  }
};

module.exports = { changeValueBattery, restartTimeAvailableUser };
