import React from 'react'
import UseFetch from '../hooks/UseFetch'
import ProductItem from '../components/ProductItem';

function MyProduct() {
  const {data,isLoading,error} = UseFetch({url:'http://localhost:8000/api/myproducts',method:'get'});

  const defaultData =new Array(10).fill(null);

  console.log('data is ',data);

    if(isLoading){
      return (
        <div className='p-2 w-275 text-blue-700
        h-[calc(100%-40px)] bg-gray-300 inline-grid grid-cols-3 rounded-xl'>
        
        {defaultData.map((product,index)=>{
          return <ProductItem product={product} key={index} loading={true}/>
        })}
          </div>
          )
      }

      if(error || data==undefined){
        return (<div>Something Went Wrong</div>)
    }
  
  return (
      <div className='p-2 w-full text-blue-700 
      h-[calc(100%-40px)] bg-gray-300 inline-grid grid-cols-3 rounded-xl gap-3'>
        {(data.length>0)?(
          data.map((product,index)=>{
               return <ProductItem product={product} key={index}/>
             })):(
          <div> Sorry You Have No Posts Yet </div>
        )}
      
    </div>
  ) 
}

export default MyProduct