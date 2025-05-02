import React, { useEffect, useState } from 'react'
import ProductItem from './ProductItem';

function ProductList() {
  const [data,setData] = useState(['first','second','third','fourth','fifth','sixth',,'third','fourth','fifth','sixth','first','second','third','fourth','fifth','sixth',,'third','fourth','fifth','sixth']);

  useEffect(()=>{
    
  },[]);  
  return (
    <div className='p-2 w-275 text-blue-700 ml-[160px] 
    h-[calc(100%-40px)] bg-black inline-grid grid-cols-3 rounded-xl'>
      
      {data.map((list,index)=>{
          return <ProductItem data={list} key={index}/>
      })}
    </div>
  )
}

export default ProductList