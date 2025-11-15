import React, { useState } from 'react';
import { motion } from 'framer-motion';
import { Facebook, Chrome, ArrowLeft } from 'lucide-react';
import { useAuth } from '../context/AuthContext';
import Button from '../components/ui/Button';
import Input from '../components/ui/Input';

const Register: React.FC = () => {
  const [formData, setFormData] = useState({
    email: '',
    password: '',
    confirmPassword: '',
    agreeToTerms: false,
  });
  const [errors, setErrors] = useState<Record<string, string>>({});
  const { register, loginWithGoogle, loginWithFacebook, isLoading } = useAuth();

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value, type, checked } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: type === 'checkbox' ? checked : value,
    }));
    
    // Clear error when user starts typing
    if (errors[name]) {
      setErrors(prev => ({ ...prev, [name]: '' }));
    }
  };

  const validateForm = () => {
    const newErrors: Record<string, string> = {};
    
    if (!formData.email) {
      newErrors.email = 'Email is required';
    } else if (!/\S+@\S+\.\S+/.test(formData.email)) {
      newErrors.email = 'Please enter a valid email';
    }
    
    if (!formData.password) {
      newErrors.password = 'Password is required';
    } else if (formData.password.length < 6) {
      newErrors.password = 'Password must be at least 6 characters';
    }
    
    if (!formData.confirmPassword) {
      newErrors.confirmPassword = 'Please confirm your password';
    } else if (formData.password !== formData.confirmPassword) {
      newErrors.confirmPassword = 'Passwords do not match';
    }
    
    if (!formData.agreeToTerms) {
      newErrors.agreeToTerms = 'You must agree to the terms and conditions';
    }
    
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    
    if (!validateForm()) return;
    
    try {
      const name = formData.email.split('@')[0]; // Extract name from email
      await register(formData.email, formData.password, name);
      // Redirect will be handled by auth context
      window.location.href = '/';
    } catch (error) {
      setErrors({ general: 'Registration failed. Please try again.' });
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-primary-50 via-white to-secondary-50 flex items-center justify-center p-4">
      <div className="w-full max-w-md">
        {/* Back Button */}
        <motion.button
          initial={{ opacity: 0, x: -20 }}
          animate={{ opacity: 1, x: 0 }}
          onClick={() => window.history.back()}
          className="flex items-center space-x-2 text-spiritual-600 hover:text-primary-600 transition-colors mb-8"
        >
          <ArrowLeft className="w-5 h-5" />
          <span>Back</span>
        </motion.button>

        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          className="bg-white/90 backdrop-blur-sm rounded-3xl p-8 shadow-strong border border-white/20"
        >
          {/* Header */}
          <div className="text-center mb-8">
            <h1 className="text-2xl font-bold text-spiritual-900 mb-2">Sign Up</h1>
            <p className="text-spiritual-600">Just a few quick things to get started</p>
          </div>

          {/* Form */}
          <form onSubmit={handleSubmit} className="space-y-6">
            {errors.general && (
              <div className="p-3 bg-error-50 border border-error-200 rounded-xl text-error-600 text-sm">
                {errors.general}
              </div>
            )}

            <div>
              <Input
                label="Email ID"
                type="email"
                name="email"
                value={formData.email}
                onChange={handleInputChange}
                placeholder="Enter Email ID"
                error={errors.email}
              />
            </div>

            <div>
              <Input
                label="New Password"
                type="password"
                name="password"
                value={formData.password}
                onChange={handleInputChange}
                placeholder="Enter New Password"
                showPasswordToggle
                error={errors.password}
              />
            </div>

            <div>
              <Input
                label="Confirm Password"
                type="password"
                name="confirmPassword"
                value={formData.confirmPassword}
                onChange={handleInputChange}
                placeholder="Enter Confirm Password"
                showPasswordToggle
                error={errors.confirmPassword}
              />
            </div>

            <div className="space-y-2">
              <label className="flex items-start space-x-3">
                <input
                  type="checkbox"
                  name="agreeToTerms"
                  checked={formData.agreeToTerms}
                  onChange={handleInputChange}
                  className="w-4 h-4 text-primary-600 border-spiritual-300 rounded focus:ring-primary-500 mt-0.5"
                />
                <span className="text-sm text-spiritual-600 leading-relaxed">
                  I Agree With The{' '}
                  <a href="/terms" className="text-primary-600 hover:text-primary-700">
                    Terms And Conditions
                  </a>
                </span>
              </label>
              {errors.agreeToTerms && (
                <p className="text-sm text-error-600 ml-7">{errors.agreeToTerms}</p>
              )}
            </div>

            <Button
              type="submit"
              variant="primary"
              className="w-full"
              loading={isLoading}
            >
              Sign Up
            </Button>

            <div className="relative">
              <div className="absolute inset-0 flex items-center">
                <div className="w-full border-t border-spiritual-200" />
              </div>
              <div className="relative flex justify-center text-sm">
                <span className="px-2 bg-white text-spiritual-500">Or with</span>
              </div>
            </div>

            <div className="grid grid-cols-2 gap-3">
              <Button
                type="button"
                variant="secondary"
                onClick={loginWithFacebook}
                className="flex items-center justify-center space-x-2"
              >
                <Facebook className="w-4 h-4 text-blue-600" />
                <span>Facebook</span>
              </Button>
              <Button
                type="button"
                variant="secondary"
                onClick={loginWithGoogle}
                className="flex items-center justify-center space-x-2"
              >
                <Chrome className="w-4 h-4 text-red-500" />
                <span>Google</span>
              </Button>
            </div>

            <div className="text-center">
              <span className="text-spiritual-600">Already have an account? </span>
              <a href="/login" className="text-primary-600 hover:text-primary-700 font-medium">
                Sign In
              </a>
            </div>
          </form>
        </motion.div>
      </div>
    </div>
  );
};

export default Register;