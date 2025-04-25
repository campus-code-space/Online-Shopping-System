import React from 'react'
import { Link } from 'react-router-dom'
function CategoryItem({ item, sub }) {
    return (
        <li className='group relative'>
            <Link to={`/${item}`} className="p-1.5 text-gray-600 hover:text-green-600">{item}</Link>
           { sub && <ul className='hidden absolute z-10 group-hover:grid hover:grid
             bg-stone-50 w-80 h-60 rounded-b-lg p-4 grid-cols-3'>
                {sub.map((item, index) => {
                     return <li className='list-disc text-green-600' key={index}>{item}</li>
                })}
            </ul>
            }
        </li>
    )
}

export default CategoryItem