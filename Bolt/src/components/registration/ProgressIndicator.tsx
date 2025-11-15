import { motion } from 'framer-motion';
import { Check } from 'lucide-react';
import type { AccountType } from '../../types/registration';

interface ProgressIndicatorProps {
  currentStep: number;
  totalSteps: number;
  accountType: AccountType;
}

const studentStepLabels = ['Account', 'Security', 'Confirm'];
const adminStepLabels = ['Admin Info', 'School Info', 'Address & Capacity', 'Security', 'Confirm'];

export default function ProgressIndicator({ currentStep, totalSteps, accountType }: ProgressIndicatorProps) {
  const stepLabels = accountType === 'student' ? studentStepLabels : adminStepLabels;

  return (
    <div className="mb-6 sm:mb-8">
      <div className="hidden lg:flex items-center justify-between">
        {Array.from({ length: totalSteps }, (_, i) => i + 1).map((step) => (
          <div key={step} className={`flex items-center ${step < totalSteps ? 'flex-1' : ''}`}>
            <div className="flex flex-col items-center">
              <motion.div
                initial={false}
                animate={{
                  scale: currentStep === step ? 1.1 : 1,
                  backgroundColor: currentStep > step ? '#16a34a' : currentStep === step ? '#2563eb' : '#e5e7eb'
                }}
                className={`w-10 h-10 rounded-full flex items-center justify-center font-bold transition-colors duration-300
                  ${currentStep > step ? 'text-white' : currentStep === step ? 'text-white' : 'text-gray-600'}`}
              >
                {currentStep > step ? (
                  <Check className="w-5 h-5" />
                ) : (
                  step
                )}
              </motion.div>
              <span className="text-xs mt-2 text-gray-600 font-medium">
                {stepLabels[step - 1]}
              </span>
            </div>
            {step < totalSteps && (
              <motion.div
                initial={false}
                animate={{
                  backgroundColor: currentStep > step ? '#16a34a' : '#e5e7eb'
                }}
                className="flex-1 h-1 mx-4 rounded transition-colors duration-300"
              />
            )}
          </div>
        ))}
      </div>

      <div className="lg:hidden">
        <div className="flex flex-col items-center gap-2 mb-3">
          <span className="text-lg font-bold text-blue-600">Step {currentStep} of {totalSteps}</span>
          <span className="text-sm text-gray-600 font-medium">
            {stepLabels[currentStep - 1]}
          </span>
        </div>
        <div className="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
          <motion.div
            initial={{ width: 0 }}
            animate={{ width: `${(currentStep / totalSteps) * 100}%` }}
            transition={{ duration: 0.5 }}
            className="h-full bg-gradient-to-r from-blue-500 to-green-500 rounded-full"
          />
        </div>
      </div>
    </div>
  );
}
