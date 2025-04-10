// src/utils/apiHelpers.js
import axios from 'axios';

export async function callName(param = 'name') {
    try {
        const request = await axios.get(URLSERVER + '/api_rapida.php?evento=callName');

        if (Array.isArray(request.data) && request.data.length > 0) {
        const response = request.data[0];
        if (param in response) {
            return response[param];
        } else {
            console.warn(`${param} no existe en el objeto.`);
            return null;
        }
        } else {
        console.warn("No se recibieron datos válidos.");
        return null;
        }
    } catch (error) {
        console.error("Error al obtener datos:", error);
        return null;
    }
}
