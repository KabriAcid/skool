import { motion, AnimatePresence } from 'framer-motion';
import { User, Mail, Lock, LockKeyhole } from 'lucide-react';
import type { StudentFormData } from '../../types/registration';

interface StudentFormProps {
  currentStep: number;
  formData: StudentFormData;
  onChange: (field: keyof StudentFormData, value: string) => void;
  errors?: Partial<Record<keyof StudentFormData, string>>;
}

const fadeInScale = {
  initial: { opacity: 0, scale: 0.95 },
  animate: { opacity: 1, scale: 1 },
  exit: { opacity: 0, scale: 0.95 },
  transition: { duration: 0.3 }
};

export default function StudentForm({ currentStep, formData, onChange, errors = {} }: StudentFormProps) {
  return (
    <AnimatePresence mode="wait">
      {currentStep === 1 && (
        <motion.div key="step1" {...fadeInScale} className="space-y-4 sm:space-y-5">
          <div>
            <div className="relative">
              <User className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="text"
                value={formData.name}
                onChange={(e) => onChange('name', e.target.value)}
                placeholder="Full Name"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.name && <span className="text-sm text-red-600 mt-1">{errors.name}</span>}
          </div>

          <div>
            <div className="relative">
              <Mail className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="email"
                value={formData.email}
                onChange={(e) => onChange('email', e.target.value)}
                placeholder="Email Address"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.email && <span className="text-sm text-red-600 mt-1">{errors.email}</span>}
          </div>
        </motion.div>
      )}

      {currentStep === 2 && (
        <motion.div key="step2" {...fadeInScale} className="space-y-4 sm:space-y-5">
          <div>
            <div className="relative">
              <Lock className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="password"
                value={formData.password}
                onChange={(e) => onChange('password', e.target.value)}
                placeholder="Password"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            <p className="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
            {errors.password && <span className="text-sm text-red-600 mt-1">{errors.password}</span>}
          </div>

          <div>
            <div className="relative">
              <LockKeyhole className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="password"
                value={formData.password_confirmation}
                onChange={(e) => onChange('password_confirmation', e.target.value)}
                placeholder="Confirm Password"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.password_confirmation && <span className="text-sm text-red-600 mt-1">{errors.password_confirmation}</span>}
          </div>
        </motion.div>
      )}

      {currentStep === 3 && (
        <motion.div key="step3" {...fadeInScale} className="space-y-4 sm:space-y-6">
          <div className="bg-blue-50 border border-blue-200 rounded-xl p-4 sm:p-6">
            <h3 className="font-bold text-base sm:text-lg text-gray-900 mb-3 sm:mb-4">Review Your Information</h3>
            <div className="space-y-2 text-sm sm:text-base">
              <p><span className="font-medium">Name:</span> {formData.name}</p>
              <p><span className="font-medium">Email:</span> {formData.email}</p>
            </div>
          </div>
        </motion.div>
      )}
    </AnimatePresence>
  );
}
