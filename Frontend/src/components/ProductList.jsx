import React, { useEffect, useState } from 'react'
import ProductItem from './ProductItem';
import axios from 'axios';
import { getUserToken } from '../auth/auth';
import UseFetch from '../hooks/UseFetch';

function ProductList() {

  const {data,isLoading,error} = UseFetch({url:'http://localhost:8000/api/products',method:'get'});

  console.log('data is',data);

  const [datad,setData] = useState(['first','second','third','fourth','fifth','sixth','third','fourth','fifth','sixth','first','second','third','fourth','fifth','sixth',,'third','fourth','fifth','sixth']);

  if(isLoading){
    return (
      <div className='p-2 w-275 text-blue-700 ml-[160px] 
      h-[calc(100%-40px)] bg-gray-300 inline-grid grid-cols-3 rounded-xl'>
      
      {datad.map((product,index)=>{
        return <ProductItem product={product} key={index} loading={true}/>
      })}
    </div>
  )
  }
  if(error){
     return (<div>It is error</div>)
  }
  if(!isLoading){
    console.log('inside the data');
    return (
      <div className='p-2 w-275 text-blue-700 ml-[160px] 
      h-[calc(100%-40px)] bg-gray-300 inline-grid grid-cols-3 rounded-xl gap-3'>
      
      {data.map((product,index)=>{
        return <ProductItem product={product} key={index}/>
      })}
    </div>
  ) 
  }
}

export default ProductList