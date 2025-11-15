import { motion, AnimatePresence } from 'framer-motion';
import { User, Phone, Mail, School, MapPin, Map, MapPinned, Users, Lock, LockKeyhole, Info, AlertCircle } from 'lucide-react';
import type { SchoolAdminFormData } from '../../types/registration';

interface SchoolAdminFormProps {
  currentStep: number;
  formData: SchoolAdminFormData;
  onChange: (field: keyof SchoolAdminFormData, value: string | number) => void;
  errors?: Partial<Record<keyof SchoolAdminFormData, string>>;
  states: string[];
}

const fadeInScale = {
  initial: { opacity: 0, scale: 0.95 },
  animate: { opacity: 1, scale: 1 },
  exit: { opacity: 0, scale: 0.95 },
  transition: { duration: 0.3 }
};

export default function SchoolAdminForm({ currentStep, formData, onChange, errors = {}, states }: SchoolAdminFormProps) {
  const totalAmount = formData.numberOfStudents * 1000;

  return (
    <AnimatePresence mode="wait">
      {currentStep === 1 && (
        <motion.div key="step1" {...fadeInScale} className="space-y-4 sm:space-y-5">
          <div className="bg-green-50 border border-green-200 rounded-xl p-3 sm:p-4 mb-4">
            <p className="text-xs sm:text-sm text-gray-700">
              <Info className="w-4 h-4 inline mr-1" />
              This will be your administrator account to manage students and exams.
            </p>
          </div>

          <div>
            <div className="relative">
              <User className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="text"
                value={formData.adminName}
                onChange={(e) => onChange('adminName', e.target.value)}
                placeholder="Administrator Full Name"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.adminName && <span className="text-sm text-red-600 mt-1">{errors.adminName}</span>}
          </div>

          <div>
            <div className="relative">
              <Phone className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="tel"
                value={formData.adminPhone}
                onChange={(e) => onChange('adminPhone', e.target.value)}
                placeholder="Administrator Phone Number"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.adminPhone && <span className="text-sm text-red-600 mt-1">{errors.adminPhone}</span>}
          </div>

          <div>
            <div className="relative">
              <Mail className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="email"
                value={formData.adminEmail}
                onChange={(e) => onChange('adminEmail', e.target.value)}
                placeholder="Administrator Email Address"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.adminEmail && <span className="text-sm text-red-600 mt-1">{errors.adminEmail}</span>}
          </div>
        </motion.div>
      )}

      {currentStep === 2 && (
        <motion.div key="step2" {...fadeInScale} className="space-y-4 sm:space-y-5">
          <div>
            <div className="relative">
              <School className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="text"
                value={formData.schoolName}
                onChange={(e) => onChange('schoolName', e.target.value)}
                placeholder="School Name"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.schoolName && <span className="text-sm text-red-600 mt-1">{errors.schoolName}</span>}
          </div>

          <div>
            <div className="relative">
              <Phone className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="tel"
                value={formData.schoolPhone}
                onChange={(e) => onChange('schoolPhone', e.target.value)}
                placeholder="School Phone Number"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.schoolPhone && <span className="text-sm text-red-600 mt-1">{errors.schoolPhone}</span>}
          </div>

          <div>
            <div className="relative">
              <Mail className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="email"
                value={formData.schoolEmail}
                onChange={(e) => onChange('schoolEmail', e.target.value)}
                placeholder="School Email Address"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.schoolEmail && <span className="text-sm text-red-600 mt-1">{errors.schoolEmail}</span>}
          </div>

          <div>
            <div className="relative">
              <MapPin className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <select
                value={formData.schoolState}
                onChange={(e) => onChange('schoolState', e.target.value)}
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              >
                <option value="">Select State</option>
                {states.map((state) => (
                  <option key={state} value={state}>{state}</option>
                ))}
              </select>
            </div>
            {errors.schoolState && <span className="text-sm text-red-600 mt-1">{errors.schoolState}</span>}
          </div>

          <div>
            <div className="relative">
              <Map className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="text"
                value={formData.schoolCity}
                onChange={(e) => onChange('schoolCity', e.target.value)}
                placeholder="City/Town"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.schoolCity && <span className="text-sm text-red-600 mt-1">{errors.schoolCity}</span>}
          </div>
        </motion.div>
      )}

      {currentStep === 3 && (
        <motion.div key="step3" {...fadeInScale} className="space-y-4 sm:space-y-5">
          <div>
            <div className="relative">
              <MapPinned className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <textarea
                value={formData.schoolAddress}
                onChange={(e) => onChange('schoolAddress', e.target.value)}
                rows={3}
                placeholder="Full School Address"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base resize-none"
                required
              />
            </div>
            {errors.schoolAddress && <span className="text-sm text-red-600 mt-1">{errors.schoolAddress}</span>}
          </div>

          <div>
            <div className="relative">
              <Users className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="number"
                value={formData.numberOfStudents || ''}
                onChange={(e) => onChange('numberOfStudents', parseInt(e.target.value) || 0)}
                min={10}
                max={10000}
                placeholder="Number of Students"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            <p className="text-xs sm:text-sm text-gray-600 mt-2">
              Cost: <span className="font-bold text-blue-600">₦{totalAmount.toLocaleString()}.00</span>
              <span className="text-gray-500"> (₦1,000 per student)</span>
            </p>
            {errors.numberOfStudents && <span className="text-sm text-red-600 mt-1">{errors.numberOfStudents}</span>}
          </div>
        </motion.div>
      )}

      {currentStep === 4 && (
        <motion.div key="step4" {...fadeInScale} className="space-y-4 sm:space-y-5">
          <div>
            <div className="relative">
              <Lock className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="password"
                value={formData.adminPassword}
                onChange={(e) => onChange('adminPassword', e.target.value)}
                placeholder="Password"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            <p className="text-xs text-gray-500 mt-1">Minimum 8 characters</p>
            {errors.adminPassword && <span className="text-sm text-red-600 mt-1">{errors.adminPassword}</span>}
          </div>

          <div>
            <div className="relative">
              <LockKeyhole className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="password"
                value={formData.adminPassword_confirmation}
                onChange={(e) => onChange('adminPassword_confirmation', e.target.value)}
                placeholder="Confirm Password"
                className="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                required
              />
            </div>
            {errors.adminPassword_confirmation && <span className="text-sm text-red-600 mt-1">{errors.adminPassword_confirmation}</span>}
          </div>
        </motion.div>
      )}

      {currentStep === 5 && (
        <motion.div key="step5" {...fadeInScale} className="space-y-4 sm:space-y-6">
          <div className="bg-blue-50 border border-blue-200 rounded-xl p-4 sm:p-6">
            <h3 className="font-bold text-base sm:text-lg text-gray-900 mb-3 sm:mb-4">Registration Summary</h3>
            <div className="space-y-2 sm:space-y-3 text-xs sm:text-sm">
              <div className="flex justify-between">
                <span className="font-medium">School Name:</span>
                <span className="text-right">{formData.schoolName}</span>
              </div>
              <div className="flex justify-between">
                <span className="font-medium">School Email:</span>
                <span className="text-right">{formData.schoolEmail}</span>
              </div>
              <div className="flex justify-between">
                <span className="font-medium">School Phone:</span>
                <span className="text-right">{formData.schoolPhone}</span>
              </div>
              <div className="flex justify-between">
                <span className="font-medium">Location:</span>
                <span className="text-right">{formData.schoolCity}, {formData.schoolState}</span>
              </div>
              <div className="flex justify-between">
                <span className="font-medium">Administrator:</span>
                <span className="text-right">{formData.adminName}</span>
              </div>
              <div className="flex justify-between">
                <span className="font-medium">Admin Phone:</span>
                <span className="text-right">{formData.adminPhone}</span>
              </div>
              <div className="flex justify-between items-center pt-2 sm:pt-3 border-t border-blue-300">
                <span className="font-bold">Students:</span>
                <span className="font-bold text-blue-600">{formData.numberOfStudents.toLocaleString()}</span>
              </div>
              <div className="flex justify-between items-center bg-yellow-50 border border-yellow-200 rounded-lg p-2 sm:p-3 mt-2 sm:mt-3">
                <span className="font-bold">Total Amount:</span>
                <span className="text-lg sm:text-xl font-bold text-yellow-700">₦{totalAmount.toLocaleString()}.00</span>
              </div>
            </div>
          </div>

          <div className="bg-green-50 border border-green-200 rounded-xl p-3 sm:p-4">
            <p className="text-xs sm:text-sm text-gray-700 leading-relaxed">
              <AlertCircle className="w-4 h-4 inline mr-1 text-green-600" />
              After registration, you'll receive payment instructions via email. Your account will be activated within 24 hours of payment confirmation.
            </p>
          </div>
        </motion.div>
      )}
    </AnimatePresence>
  );
}
