# -----------------------------------------------------------------------------
# Stage 1: Build Dependencies - Optimized for npm caching
# This stage installs all node_modules to be reused in subsequent stages.
# -----------------------------------------------------------------------------
FROM node:18-alpine AS deps
RUN apk add --no-cache curl # Keep curl if needed for healthchecks or other image-specific tools
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci # Installs dependencies cleanly based on package-lock.json

# -----------------------------------------------------------------------------
# Stage 2: Development Runner - For Local Development (npm run dev)
# This stage is optimized for hot-reloading with bind mounts.
# -----------------------------------------------------------------------------
FROM node:18-alpine AS dev_runner
WORKDIR /app
# Copy only node_modules from the 'deps' stage to leverage caching
COPY --from=deps /app/node_modules ./node_modules
# Copy all application source code
COPY . .
# Expose the development port
EXPOSE 3000
# Command to start the development server
CMD ["npm", "run", "dev"]

# -----------------------------------------------------------------------------
# Stage 3: Production Builder - Creates the optimized Next.js production build
# -----------------------------------------------------------------------------
FROM node:18-alpine AS builder
WORKDIR /app
# Copy node_modules from the 'deps' stage
COPY --from=deps /app/node_modules ./node_modules
# Copy all application source code
COPY . .

# Set NODE_ENV to production for the build process
ENV NODE_ENV=production
# Build the Next.js application for production
RUN npm run build

# -----------------------------------------------------------------------------
# Stage 4: Production Runner - The final, lean production image
# This stage uses Next.js's "standalone" output mode for a minimal image.
# -----------------------------------------------------------------------------
FROM node:18-alpine AS prod_runner
# Next.js recommends running as a non-root user for security in production
# This user needs sufficient permissions to read the /app directory.
RUN addgroup --system --gid 1001 nodejs
RUN adduser --system --uid 1001 nextjs
USER nextjs

WORKDIR /app

# Copy only the essential build output from the 'builder' stage
# The 'standalone' folder contains everything needed to run the app
COPY --from=builder /app/.next/standalone ./

# ✅ Copy the static files into expected location
COPY --from=builder /app/.next/static ./.next/static

# ✅ Copy public folder
COPY --from=builder /app/public ./public

# Set environment variables for production runtime
ENV NODE_ENV=production
ENV NEXT_TELEMETRY_DISABLED=1

# Expose the production port
EXPOSE 3000
# Command to start the Next.js production server in standalone mode
# The standalone output typically generates a server.js in the root of the standalone folder
CMD ["node", "server.js"]