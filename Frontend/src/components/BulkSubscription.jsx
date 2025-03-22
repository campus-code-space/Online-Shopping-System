import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { ArrowLeft, Package, Calendar, Truck, RefreshCw } from 'lucide-react';

export default function BulkSubscription() {
  const [selectedPlan, setSelectedPlan] = useState('');
  
  const subscriptionPlans = [
    {
      id: 'weekly',
      name: 'Weekly Plan',
      description: 'Fresh groceries delivered every week',
      discount: '15% off',
      minOrder: '$100',
      deliveryDay: 'Choose any day',
      icon: RefreshCw
    },
    {
      id: 'biweekly',
      name: 'Bi-Weekly Plan',
      description: 'Grocery delivery every two weeks',
      discount: '12% off',
      minOrder: '$150',
      deliveryDay: 'Choose any day',
      icon: Calendar
    },
    {
      id: 'monthly',
      name: 'Monthly Plan',
      description: 'Monthly bulk delivery',
      discount: '20% off',
      minOrder: '$200',
      deliveryDay: 'Choose any day',
      icon: Package
    }
  ];

  const popularItems = [
    {
      name: 'Fresh Vegetables Pack',
      price: '$49.99',
      image: 'https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=500&q=80',
      description: '5kg mixed seasonal vegetables'
    },
    {
      name: 'Fruit Bundle',
      price: '$39.99',
      image: 'https://images.unsplash.com/photo-1610832958506-aa56368176cf?auto=format&fit=crop&w=500&q=80',
      description: '4kg mixed seasonal fruits'
    },
    {
      name: 'Dairy Essentials',
      price: '$45.99',
      image: 'https://images.unsplash.com/photo-1628088062854-d1870b4553da?auto=format&fit=crop&w=500&q=80',
      description: 'Milk, cheese, yogurt package'
    }
  ];

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <div className="bg-green-600 text-white py-6">
        <div className="container mx-auto px-4">
          <Link to="/dashboard" className="inline-flex items-center text-white hover:text-green-100 mb-4">
            <ArrowLeft className="h-5 w-5 mr-2" />
            Back to Dashboard
          </Link>
          <div className="flex items-center">
            <Package className="h-8 w-8 mr-3" />
            <h1 className="text-3xl font-bold">Bulk Subscription Plans</h1>
          </div>
        </div>
      </div>

      {/* Main Content */}
      <div className="container mx-auto px-4 py-8">
        {/* Benefits Section */}
        <div className="bg-white rounded-lg shadow-sm p-6 mb-8">
          <h2 className="text-2xl font-bold mb-6">Why Choose Bulk Subscription?</h2>
          <div className="grid md:grid-cols-3 gap-6">
            <div className="flex items-start">
              <div className="bg-green-100 rounded-full p-3 mr-4">
                <Package className="h-6 w-6 text-green-600" />
              </div>
              <div>
                <h3 className="font-semibold mb-2">Bulk Savings</h3>
                <p className="text-gray-600">Save up to 20% on your regular grocery shopping</p>
              </div>
            </div>
            <div className="flex items-start">
              <div className="bg-blue-100 rounded-full p-3 mr-4">
                <Truck className="h-6 w-6 text-blue-600" />
              </div>
              <div>
                <h3 className="font-semibold mb-2">Scheduled Delivery</h3>
                <p className="text-gray-600">Never run out of essentials with regular deliveries</p>
              </div>
            </div>
            <div className="flex items-start">
              <div className="bg-purple-100 rounded-full p-3 mr-4">
                <Calendar className="h-6 w-6 text-purple-600" />
              </div>
              <div>
                <h3 className="font-semibold mb-2">Flexible Plans</h3>
                <p className="text-gray-600">Choose delivery frequency that suits your needs</p>
              </div>
            </div>
          </div>
        </div>

        {/* Subscription Plans */}
        <h2 className="text-2xl font-bold mb-6">Choose Your Plan</h2>
        <div className="grid md:grid-cols-3 gap-6 mb-12">
          {subscriptionPlans.map((plan) => (
            <div 
              key={plan.id}
              className={`bg-white rounded-lg shadow-sm p-6 border-2 cursor-pointer transition-all ${
                selectedPlan === plan.id ? 'border-green-600' : 'border-transparent'
              }`}
              onClick={() => setSelectedPlan(plan.id)}
            >
              <div className="flex items-center mb-4">
                <div className="bg-green-100 rounded-full p-3 mr-3">
                  <plan.icon className="h-6 w-6 text-green-600" />
                </div>
                <h3 className="text-xl font-semibold">{plan.name}</h3>
              </div>
              <p className="text-gray-600 mb-4">{plan.description}</p>
              <ul className="space-y-2 mb-6">
                <li className="flex items-center text-gray-700">
                  <span className="w-24">Discount:</span>
                  <span className="font-semibold text-green-600">{plan.discount}</span>
                </li>
                <li className="flex items-center text-gray-700">
                  <span className="w-24">Min Order:</span>
                  <span>{plan.minOrder}</span>
                </li>
                <li className="flex items-center text-gray-700">
                  <span className="w-24">Delivery:</span>
                  <span>{plan.deliveryDay}</span>
                </li>
              </ul>
              <button 
                className={`w-full py-2 px-4 rounded-md transition-colors ${
                  selectedPlan === plan.id
                    ? 'bg-green-600 text-white hover:bg-green-700'
                    : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
                }`}
              >
                Select Plan
              </button>
            </div>
          ))}
        </div>

        {/* Popular Bulk Items */}
        <h2 className="text-2xl font-bold mb-6">Popular Bulk Items</h2>
        <div className="grid md:grid-cols-3 gap-6">
          {popularItems.map((item, index) => (
            <div key={index} className="bg-white rounded-lg shadow-sm overflow-hidden">
              <img 
                src={item.image} 
                alt={item.name}
                className="w-full h-48 object-cover"
              />
              <div className="p-4">
                <h3 className="font-semibold text-lg mb-2">{item.name}</h3>
                <p className="text-gray-600 text-sm mb-3">{item.description}</p>
                <div className="flex items-center justify-between">
                  <span className="text-xl font-bold text-green-600">{item.price}</span>
                  <button className="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 transition-colors">
                    Add to Cart
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}