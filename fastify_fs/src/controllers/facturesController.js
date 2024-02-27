async function getLastFactureOfClient(request, reply) {
    
    const { id } = request.params
    const token = request.headers['token']
    let data;

    if (!id) return reply.code(400).send({ message: 'Id is required' }) // Comprobamos si hay id
    
    if (!token) return reply.code(401).send({ message: 'Token is required' }) // Comprobamos si hay token 

    // Peticion a facturascript para obtener todas las facturas ya que no podemos filtrar por cliente

    try {
        const response = await fetch('https://fsbikes.bellidel.eu/api/3/facturaclientes', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'token': token
            }
        })
        data = await response.json()
    } catch (error) {
        console.log(error);
        return reply.code(500).send({ message: 'Internal server error data facturas' })
    }

    if (data.length == 0) return reply.code(404).send({ message: 'Facturas not found' }) // Comprobamos si hay facturas
    
    const facturas = data.filter(factura => factura.codcliente == id)

    if (facturas.length == 0) return reply.code(404).send({ message: 'Facturas not found' }) // Comprobamos si hay facturas del cliente

    facturas.sort((a, b) => new Date(b.fecha) - new Date(a.fecha))
    const lastFacture = facturas.at(0)
    // Sumamos un mes a la fecha de la última factura y comprobamos si es mayor que la fecha actual
    const date = new Date(lastFacture.fecha)
    date.setMonth(date.getMonth() + 1)

    let isValid = false;

    if (date > new Date()) {
        isValid = true;
    } else {
        isValid = false;
    }

    return { lastFacture, isValid }; // { "lastFacture": "datos": "datos", "isValid": true/false}
}

module.exports = {
    getLastFactureOfClient,
}