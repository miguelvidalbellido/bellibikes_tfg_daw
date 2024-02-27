const axios = require("axios");
require("dotenv").config();

const url = process.env.FS_API_ENDPOINT;
const token = process.env.FS_TOKEN;

const getProducts = async () => {
  try {
    const response = await axios.get(url, {
      headers: {
        token: token,
      },
    });
    return response.data;
  } catch (error) {
    console.log("Error api facturascripts:", error);
    return null;
  }
};

module.exports = {
  getProducts,
};
