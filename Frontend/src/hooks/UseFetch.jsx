import React, { useEffect, useState } from 'react'
import axios from 'axios';
import { getUserToken } from '../auth/auth';

function UseFetch({url,method}) {

    const token = getUserToken();
    const [data,setData] = useState([]);
    const [isLoading,setIsLoading] = useState(null);
    const [error,setError] = useState(false);

    useEffect(()=>{
        
        const getData=async()=>{
            try{
                setIsLoading(true);
                let response = await axios({
                    url: url,
                    method: method,
                    headers: { 'Authorization': `Bearer ${token}` }
                });
                console.log('response is ',response.data);
                console.log('response is ',response.data.product_list);
                setData(response.data.product_list);
                setIsLoading(false);

            }catch(err){
                console.log(err);
                setError(err);  
                setIsLoading(false);
            }
        }
        getData();
        },[]);


  return {data,isLoading,error}
}

export default UseFetch