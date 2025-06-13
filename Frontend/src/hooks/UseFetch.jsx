import React, { useEffect, useState } from 'react'
import axios from 'axios';
import { getUserToken } from '../auth/auth';

function UseFetch({ url, method, params = {} }) {
    const token = getUserToken();
    const [data, setData] = useState([]);
    const [isLoading, setIsLoading] = useState(null);
    const [error, setError] = useState(false);

    useEffect(() => {
        const getData = async () => {
            try {
                setIsLoading(true);
                const response = await axios({
                    url,
                    method,
                    headers: { Authorization: `Bearer ${token}` },
                    params
                });
                setData(response.data.product_list || response.data);
                setIsLoading(false);
            } catch (err) {
                console.log(err);
                setError(err);
                setIsLoading(false);
            }
        };
        getData();
    }, [url, method, JSON.stringify(params)]); // Watch for param changes

    return { data, isLoading, error };
}

export default UseFetch