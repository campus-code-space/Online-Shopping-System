
import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import { ToastContainer, toast } from "react-toastify";
import { ArrowLeft } from 'lucide-react';
import axios from 'axios';
import defaultImage from '../assets/default_image.png'
import { calc_image_size, getBase64Img  } from '../helper/imageConverter';
import { getUserToken } from '../auth/auth';
import { CATEGORIES } from '../helper/categories';
export default function ProductPost() {

  const navigate = useNavigate();
  const [productData, setProductData] = useState({
    productName: '',
    productImage: '',
    productPrice: '',
    stock_quantity: '',
    final_price: '',
    sold: "",
    productCategory: 'Fruit',
    productSubCategory: 'Berries',
  });  

  const [image,setImage] = useState(defaultImage);

  let copiedCategory = [...CATEGORIES];
  copiedCategory.shift();

  let subCategories = [];

  copiedCategory.map((category)=>{
       subCategories.push(...category.sub);
  });

 
  const handleSubmit = async (e) => {
    e.preventDefault();
    const token = getUserToken();
    try {
      let response = await axios({
        url:'http://localhost:8000/api/products',
        data:productData,
        method:'post',
        headers:{'Authorization':`Bearer ${token}`}
      });
      console.log(JSON.stringify(response.data));
      if (response.data.status) {

        toast.success(`${response.data.message}`, {position: "top-center",autoClose: 5000,hideProgressBar: false,
          closeOnClick: false,pauseOnHover: true,draggable: true,progress: undefined, theme: "light",
        });

        setTimeout(()=>{
         navigate('/vendor-management');
        },1300);

      } else {
        toast.error(`${response.data.message}`, { position: "top-center",autoClose: 5000,hideProgressBar: false,closeOnClick: false,
        pauseOnHover: true,draggable: true,progress: undefined,theme: "light",
        });
      }
    } catch (e) {
      console.log(e);
    }
  };
  const handleChange = (e) => {
    setProductData((prev) => {
      return { ...prev, [e.target.name]: e.target.value }
    });
  }
  const handleImageChange = async (e) => {
    let file = e.target.files[0];
    let image;
    try {
      image = await getBase64Img(file);
      setImage(image);
    }catch(e){
      console.log(e);
    }
    setProductData((prev) => {
      const newData = {...prev,
        productImage:image
      };
      return newData;
    });
  }
    
    return (
    <div className='flex w-full  items-center gap-5 bg-gray-50'>
      <div className="grow min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <ToastContainer />
        <div className="sm:mx-auto sm:w-full sm:max-w-md">
          <Link to="/vendor-management" className="flex items-center text-green-600 hover:text-green-700 mb-6 mx-4">
            <ArrowLeft className="h-5 w-5 mr-2" />
            Back
          </Link>
          <h2 className="text-center text-3xl font-extrabold text-gray-900">Post your Product</h2>
        </div>

        <div className="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
          <div className="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <form className="space-y-6" onSubmit={handleSubmit}>
              <div>
                <label htmlFor="name" className="block text-sm font-medium text-gray-700">
                  Product Name
                </label>
                <div className="mt-1">
                  <input id="name" name="productName" type="text" autoComplete="name" required
                    value={productData.productName}
                    onChange={handleChange}
                    className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                  />
                </div>
              </div>

              <div>
                <label htmlFor="productImage" className="block text-sm font-medium text-gray-700">
                  Product Image
                </label>
                <div className="mt-1">
                  <input id="productImage" name="productImage" type="file" required
                    onChange={handleImageChange}
                    className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                  />
                </div>
              </div>

              <div>
                <label htmlFor="productPrice" className="block text-sm font-medium text-gray-700">
                  Product Price
                </label>
                <div className="mt-1">
                  <input id="productPrice" name="productPrice" type="number" required
                    value={productData.productPrice}
                    onChange={handleChange}
                    className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                  />
                </div>
              </div>
              <div>
                <label htmlFor="stock_quantity" className="block text-sm font-medium text-gray-700">
                  Stock Quantity
                </label>
                <div className="mt-1">
                  <input
                    id="stock_quantity"
                    name="stock_quantity"
                    type="number"
                    required
                    value={productData.stock_quantity}
                    onChange={handleChange}
                    className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                  />
                </div>
              </div>
              <div>
                <label htmlFor="final_price" className="block text-sm font-medium text-gray-700">
                  Final Price
                </label>
                <div className="mt-1">
                  <input id="final_price" name="final_price" type="number" required
                    value={productData.final_price}
                    onChange={handleChange}
                    className="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-green-500 focus:border-green-500"
                  />
                </div>
              </div>
              <div>
                <label htmlFor="Category" className="block text-sm font-medium text-gray-700">
                  Category
                </label>
                <div className="mt-1">
                  <select name="productCategory" id="Category" onChange={handleChange}>
                    <option value='Fruit'>Fruit</option>
                    <option value='Vegetable'>Vegetable</option>
                    <option value='Bakery'>Bakery</option>
                    <option value='Diary'>Diary</option>
                    <option value='Beverage'>Beverage</option>
                  </select>
                </div>
              </div>
              <div>
                <label htmlFor="subCategory" className="block text-sm font-medium text-gray-700">
                  Sub Category
                </label>
                <div className="mt-1">
                  <select name="productSubCategory" id="subCategory" onChange={handleChange}>
                      {
                      subCategories.map((sub,index)=>{
                        return (<option key={index} value={sub}>{sub}</option>)
                      })
                      }
                  </select>
                </div>
              </div>
              <div>
                <button
                  type="submit"
                  className="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                  Post
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <img src={image} width='400' height='200' id='image' alt="Default Image" className='h-100 rounded-lg max-w-md m-5.5'/>
    </div>
  );

}